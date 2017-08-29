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

class showAllGrade extends Job implements SelfHandling

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

        $grades = Grade::with('posts')
            ->where('updated_at', '<=', Carbon::now())
            ->orderBy('updated_at','desc')
            ->simplePaginate(config('blog.post_per_page'));

        return [
            'title' => config('blog.title'),
            'subtitle' => config('blog.subtitle'),
            'grades' => $grades,
            'page_image' => config('blog.page_image'),
            'meta_description' => config('blog.description'),
            'reverse_direction' => false,
            'grade' => null,
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
        echo 'This is an impossible situation.'.$grade;
    }
}
