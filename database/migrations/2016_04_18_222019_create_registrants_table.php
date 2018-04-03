<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ssn');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('phone_number');
            $table->primary('ssn');
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
        Schema::drop('registrants');
    }
}
