<?php

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('hours');
            $table->float('fees');
            $table->string('material')->nullable();
            $table->longText('outline');
            $table->text('objective');
            $table->text('target');
            $table->integer('min_registrants');
            $table->integer('max_registrants');
            $table->date('registration_deadline');
            $table->integer('category_id')->unsigned();

            $table->timestamps();


            //$table->primary('id');
        });

        Schema::table('courses',function(Blueprint $table){
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
