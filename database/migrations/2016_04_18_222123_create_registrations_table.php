<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_registrant', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('course_id')->unsigned();
            $table->string('registrant_id');
            $table->dateTime('date_time');
            $table->char('confirmed',1)->default(0);
            $table->string('code');
            $table->timestamps();
            $table->primary(['course_id','registrant_id']);


        });

        Schema::table('course_registrant', function (Blueprint $table) {

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('registrant_id')->references('ssn')->on('registrants')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_registarnt');
    }
}
