<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Grade extends Model
{
    protected $fillable = [
        'grade', 'title', 'subtitle', 'page_image', 'meta_description',
        'reverse_direction','updated_at'
    ];
    /**
     * The many-to-many relationship between grades and posts.
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_grade_pivot');
    }
    public function father_grade()
    {
        return $this->belongsToMany('App\Grade', 'grade_grade_pivot','child_grade_id','father_grade_id');
    }

    /**
     * Add any grades needed from the list
     *
     * @param array $grades List of grades to check/add
     */
    public static function addNeededGrades(array $grades)
    {
        if (count($grades) === 0) {
            return;
        }

        $found = static::whereIn('grade', $grades)->lists('grade')->all();

        foreach (array_diff($grades, $found) as $grade) {
            static::create([
                'grade' => $grade,
                'title' => $grade,
                'subtitle' => 'Subtitle for '.$grade,
                'page_image' => '',
                'meta_description' => '',
                'reverse_direction' => false,
                'updated_at' =>''
            ]);
        }
    }


    public function syncFatherGrades(array $father_grade)
    {

        if (count($father_grade)) {
            $this->father_grade()->sync(
                Grade::whereIn('grade', $father_grade)->lists('id')->all()
            );
            return;
        }

        $this->father_grade()->detach();
    }

    /**
     * Return the index layout to use for a grade
     *
     * @param string $grade
     * @param string $default
     * @return string
     */
    public static function layout($grade, $default = 'article_system.layouts.index')
    {
        $layout = static::whereGrade($grade)->pluck('layout');

        return $layout ?: $default;
    }
    public function url($base = '/article_system?grade=%grade%')
    {
       $url=str_replace('%grade%',urlencode($this->grade),$base);
        return $url;
    }


}
