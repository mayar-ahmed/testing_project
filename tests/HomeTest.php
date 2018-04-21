<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    #function to test branch coverage on index method
    public function testIndex()
    {
        #invoke route and see content of the page
        $res= $this->visit('/')->see('Best Training')->see('Latest Courses');

        //equivalent test case code, invokes the function directly
////        $res= $this->call('Get', '/');
////
////        $data = $res->getContent();
////        $this->assertContains('Best Training' , $data);
//        #dd($data);


    }

    public function testContact()
    {
        #invoke route and see content of the page

        $res= $this->visit('/contactus')->see('contact details')->see('send us a message');


    }

}
