<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeGradePivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_grade_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('father_grade_id')->unsigned()->index();
            $table->integer('child_grade_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::drop('grade_grade_pivot');
    }
}
