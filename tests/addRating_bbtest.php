<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class addRating_bbtest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1()
    {

        #text case1 : empty rating field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Rate')
            ->see('The rating field is required');

    }

    public function test2(){
        #text case2 : empty code field
        $this->visit('/course_description/2')
            ->type('2.5', 'rating')
            ->press('Rate')
            ->see('The code field is required');
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
        #test case 4: rating must be a number
        $this->visit('/course_description/2')
            ->type('cda5b5c', 'code')
            ->type('mmm', 'rating')
            ->press('Rate')
            ->see('The rating must be a number');
    }

    public function test5(){
        #test case 5: course id not an integer
        $resp=$this->call('POST', '/course_description/c/addrating' ,['code'=>'222', 'rating'=>3]);
        $this->assertRedirectedTo('http://localhost');
    }

    public function test6(){
        #test case 6: course id is anegative number
        $resp=$this->call('POST', '/course_description/-1/addrating' ,['code'=>'222', 'rating'=>5]);
        $this->assertRedirectedTo('http://localhost');
    }


    ///additional test cases for base choice coverage

    //failure
    public function test7(){
        #test case 57: rating <0
        $this->visit('/course_description/2')
            ->type('cda5b5c', 'code')
            ->type('-1', 'rating')
            ->press('Rate')
            ->see('The rating must be between 0 and 5');
    }

    //failure
    public function test8(){
        #test case 8: rating >5
        $this->visit('/course_description/2')
            ->type('cda5b5c', 'code')
            ->type('12', 'rating')
            ->press('Rate')
            ->see('The rating must be between 0 and 5');
    }


}
