<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradeTableSeeder extends Seeder
{
    /**
     * Seed the grades table
     */
    public function run()
    {
        Grade::truncate();

        factory(Grade::class, 5)->create();
    }
}