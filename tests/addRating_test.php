<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class addRating_test extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    //logic and branch coverage for add rating function
    public function test1()
    {
        #test case1 : empty rating field
        $this->visit('/course_description/2')
            ->press('Rate')
            ->see('The rating field is required');
    }

    public function test2(){
        #test case 2: invalid course id -->redirect back to current page
        $resp=$this->call('POST', '/course_description/-1/addrating' ,['code'=>'222', 'rating'=>'blabla']);
        $this->assertRedirectedTo('http://localhost');

    }

    public function test3(){
        #test case 3 : confirmed registrant who hasn't rated  before
        $this->visit('/course_description/2')
            ->type('cda5b5c', 'code')
            ->type('2.5', 'rating')
            ->press('Rate')
            ->see('Rating Added successfully');
    }

    public function test4(){
        #test case 4: confirmed registrant rates again
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('3.5', 'rating')
            ->press('Rate')
            ->see('your already rated this course');
    }

    public function test5(){

        #test case 5: unconfirmed registrant
        $this->visit('/course_description/2')
            ->type('06e47c6', 'code')
            ->type('2', 'rating')
            ->press('Rate')
            ->see('your registration isn\'t confirmed yet to rate');
    }

    public function test6(){

        #test case 6 : not registered in the course
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->type('4', 'rating')
            ->press('Rate')
            ->see('you aren\'t registered in this course');
    }
}
