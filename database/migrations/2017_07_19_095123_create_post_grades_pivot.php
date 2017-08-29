<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePostGradesPivot extends Migration
{
    /*
     * Run the migration.
     * */
    public function up() {
        Schema::create(
            'post_grades_pivot',
            function (Blueprint $table){
                $table->increments('id');
                $table->integer('post_id')->unsigned()->index();
                $table->integer('grade_id')->unsigned()->index();
            }
        );
    }
    /*
     * Reverse the migration.
     * */
    public function down() {
        Schema::drop('post_grades_pivot');
    }
}