<?php

namespace App\Jobs;

use App\Post;
use App\Grade;
use Carbon\Carbon;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use DB;
class Article_systemIndexData extends Job implements SelfHandling

{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $grade;

    /**
     * Constructor
     *
     * @param string|null $grade
     */
    public function __construct($grade)
    {
        $this->grade = $grade;
    }

    /**
     * Execute the command.
     *
     * @return array
     */
    public function handle()
    {
        if ($this->grade) {
            return $this->gradeIndexData($this->grade);
        }

        return $this->normalIndexData();
    }

    /**
     * Return data for normal index page
     *
     * @return array
     */
    protected function normalIndexData()
    {
        $posts = Post::with('grades')
            ->where('publish_at', '<=', Carbon::now())
            ->where('is_draft', 0)
            ->orderBy('publish_at', 'desc')
            ->simplePaginate(config('blog.posts_per_page'));

        return [
            'title' => config('blog.title'),
            'subtitle' => config('blog.subtitle'),
            'posts' => $posts,
            'page_image' => config('blog.page_image'),
            'meta_description' => config('blog.description'),
            'reverse_direction' => false,
            'grade' => null,
            'gradesss'=>''
        ];

    }

    /**
     * Return data for a grade index page
     *
     * @param string $grade
     * @return array
     */
    protected function gradeIndexData($grade)
    {
        $grade = Grade::where('grade', $grade)->firstOrFail();
        $reverse_direction = (bool)$grade->reverse_direction;

        $posts = Post::where('publish_at', '<=', Carbon::now())
            ->whereHas('grades', function ($q) use ($grade) {
                $q->where('grade', '=', $grade->grade);
            })
            ->where('is_draft', 0)
            ->orderBy('publish_at', $reverse_direction ? 'asc' : 'desc')
            ->simplePaginate(config('blog.posts_per_page'));
        $posts->addQuery('grade', $grade->grade);

        $gradesss = Grade::where('updated_at','<=',Carbon::now())
            ->whereHas('father_grade',function ($q) use($grade) {
            $q->where('father_grade_id','=',$grade->id);
        })
        ->orderBy('updated_at','desc')
        ->get();

        $page_image = $grade->page_image ?: config('blog.page_image');

        return [
            'title' => $grade->title,
            'subtitle' => $grade->subtitle,
            'posts' => $posts,
            'page_image' => $page_image,
            'grade' => $grade,
            'reverse_direction' => $reverse_direction,
            'meta_description' => $grade->meta_description ?: config('blog.description'),
            'gradesss' => $gradesss
        ];
    }
}
