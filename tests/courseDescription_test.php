<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class courseDescription_test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    //Search
    
	//Course Description
    public function test1_course_description()
    {
    	$this->visit('/course_description/2')
             ->see('Management')
             ->see('Details')
             ->see('Material')
             ->see('Reviews');
    }
	

	//FAILURE!!
    public function test2_course_description()
    {
    	$this->visit('/course_description/3')
             ->see("Course id = 3 doesn't exist");
    }

}
