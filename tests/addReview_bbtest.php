<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class addReview_bbtest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    //black box coverage for add revie function
    public function test1()
    {
        #text case1 : empty review field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Add a Review')
            ->see('The review field is required');

    }

    public function test2(){
        #text case1 : empty code field
        $this->visit('/course_description/2')
            ->type('this is so great', 'review')
            ->press('Add a Review')
            ->see('The code field is required');
    }

    public function test3(){
        #test case 3 : all valid
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('Review Added successfully');
    }

    public function test4(){
        #test case 4: course id not an integer
        $resp=$this->call('POST', '/course_description/c/addreview' ,['code'=>'222', 'review'=>'crap']);
        $this->assertRedirectedTo('http://localhost');
    }

    public function test5(){
        #test case 4: course id is anegative number
        $resp=$this->call('POST', '/course_description/-1/addreview' ,['code'=>'222', 'review'=>'crap']);
        $this->assertRedirectedTo('http://localhost');
    }
}
