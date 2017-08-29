<?php

namespace App;

use App\Http\Requests\Request;
use App\Services\Markdowner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Services\UploadsManager;
class Post extends Model
{
    protected $dates = ['publish_at'];
    protected $fillable = [
        'title', 'subtitle', 'content_raw', 'page_image', 'meta_description',
        'layout', 'is_draft', 'publish_at',
    ];

    /**
     * The many-to-many relationship between posts and grades.
     *
     * @return BelongsToMany
     */
    public function grades()
    {
        return $this->belongsToMany('App\Grade', 'post_grade_pivot');
    }

    /**
     * Set the title attribute and automatically the slug
     *
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }

    /**
     * Recursive routine to set a unique slug
     *
     * @param string $title
     * @param mixed $extra
     */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Sync grade relation adding new grades as needed
     *
     * @param array $grades
     */
    public function syncGrades(array $grades)
    {
        Grade::addNeededGrades($grades);

        if (count($grades)) {
            $this->grades()->sync(
                Grade::whereIn('grade', $grades)->lists('id')->all()
            );
    return;
        }


    }
    /*
     * sync folder for post .
     * */
    public function syncFolder($folder)
    {
        $new_folder = $folder;
        $folder = 'root'.'/'.$new_folder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("文件夹 '$new_folder' 创建成功");
        }

        $error = $result ? : "创建目录时发生一个错误";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }
    /**
     * Return the date portion of publish_at
     */
    public function getPublishDateAttribute($value)
    {
        return $this->publish_at->format('M-j-Y');
    }

    /**
     * Return the time portion of publish_at
     */
    public function getPublishTimeAttribute($value)
    {
        return $this->publish_at->format('g:i A');
    }

    /**
     * Alias for content_raw
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }

    /**
     * Return URL to post
     *
     * @param Grade $grade
     * @return string
     */
    public function url(Grade $grade = null)
    {
        $url = url('article_system/'.$this->slug);
        if ($grade) {
            $url .= '?grade='.urlencode($grade->grade);
        }
        return $url;
    }

    /**
     * Return array of grade links
     *
     * @param string $base
     * @return array
     */
    public function gradeLinks($base = '/article_system?grade=%grade%')
    {
        $grades = $this->grades()->lists('grade');
        $return = [];
        foreach ($grades as $grade) {
            $url = str_replace('%grade%', urlencode($grade), $base);
            $return[] = '<a href="'.$url.'">'.e($grade).'</a>';
        }
        return $return;
    }

    /**
     * Return next post after this one or null
     *
     * @param Grade $grade
     * @return Post
     */
    public function newerPost(Grade $grade = null)
    {
        $query =
            static::where('publish_at', '>', $this->publish_at)
                ->where('publish_at', '<=', Carbon::now())
                ->where('is_draft', 0)
                ->orderBy('publish_at', 'asc');
        if ($grade) {
            $query = $query->whereHas('grades', function ($q) use ($grade) {
                $q->where('grade', '=', $grade->grade);
            });
        }

        return $query->first();
    }

    /**
     * Return older post before this one or null
     *
     * @param Grade $grade
     * @return Post
     */
    public function olderPost(Grade $grade = null)
    {
        $query =
            static::where('publish_at', '<', $this->publish_at)
                ->where('is_draft', 0)
                ->orderBy('publish_at', 'desc');
        if ($grade) {
            $query = $query->whereHas('grades', function ($q) use ($grade) {
                $q->where('grade', '=', $grade->grade);
            });
        }

        return $query->first();
    }

}
