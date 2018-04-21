<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class courseDescription_test extends TestCase
{
    /**
     * @return void
     */
    
    //Search
    
    //Course Description
    public function test1()
    {
        $this->visit('/course_description/2')
             ->see('Management')
             ->see('Details')
             ->see('Material')
             ->see('Reviews');
    }
    

    //FAILURE!!
    public function test2()
    {
        $this->visit('/course_description/g')
             ->seePageIs('/');
    }
    public function test3()
    {
        $this->visit('/course_description/0.5')
             ->seePageIs('/');
    }
    public function test4()
    {
        $this->visit("/course_description/")
             ->seePageIs('/');
    }
    public function test5()
    {
        $this->visit('/course_description/-1')
             ->seePageIs('/');
    }
    public function test6()
    {
        $this->visit('/course_description/0')
             ->seePageIs('/');
    }
}
