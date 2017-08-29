<?php

use App\Post;
use App\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Seed the posts table
     */
    public function run()
    {
        // Pull all the grade names from the file
        $grades = Grade::lists('grade')->all();

        Post::truncate();

        // Don't forget to truncate the pivot table
        DB::table('post_grade_pivot')->truncate();

        factory(Post::class, 20)->create()->each(function ($post) use ($grades) {

            // 30% of the time don't assign a grade
            if (mt_rand(1, 100) <= 30) {
                return;
            }

            shuffle($grades);
            $postGrades = [$grades[0]];

            // 30% of the time we're assigning grades, assign 2
            if (mt_rand(1, 100) <= 30) {
                $postGrades[] = $grades[1];
            }

            $post->syncGrades($postGrades);
        });
    }
}