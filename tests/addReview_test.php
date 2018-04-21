<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class addReview_test extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    //logic coverage and branch function for add review function

    public function test1()
    {
        #text case1 : empty review field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Add a Review')
            ->see('The review field is required');

    }

    public function test2(){
        #test case 2: invalid course id -->redirect
        $resp=$this->call('POST', '/course_description/-1/addreview' ,['code'=>'222', 'review'=>'crap']);
        $this->assertRedirectedTo('http://localhost');
    }

    public function test3(){
        #test case 3 : confirmed registrant
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('Review Added successfully');

        $this->seeInDatabase('reviews', ['review'=>'this course was great', 'course_id'=>2]);
    }

    public function test4(){
        #test case 4: unconfirmed registrant
        $this->visit('/course_description/2')
            ->type('06e47c6', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('your registration isn\'t confirmed yet to add a review');
    }

    public function test5(){
        #test case 5 : not registered in the course
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('you aren\'t registered in this course');

    }


}

