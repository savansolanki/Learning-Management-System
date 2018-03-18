<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->integer('category');
            $table->integer('sub_category');
            $table->string('level')->comment('Cource Level');
            $table->string('question_1')->comment('What knowledge & tools are required?');
            $table->string('question_2')->comment('Who should take this course?');
            $table->string('question_3')->comment('What will students achieve after taking your course?');
            $table->string('course_image')->default('default.png');;
            $table->tinyInteger('status')->default('0')->comment('0 = In-Active , 1 = Active');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
