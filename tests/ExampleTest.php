<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
//        $this->visit('/')
//             ->click('Contact Us')
//            ->seePageIs('/contactus');
//
//        $this->visit('/contactus')
//            ->click('business')->seePageIs('/courses/1');

//        $this->visit('/course_description/2/')
//            ->type('1234', 'name')
//            ->type('salma@gmail.com', 'email')
//            ->type('12312312312311', 'ssn')
//            ->type('haram','address')
//            ->type('mmm', 'phone_number')
//            ->press('Submit')
//            ->seeInSession('errors');


        #works well

        $this->visit("/course_description/2")
            ->type('455','code')
            ->type('xskskjdskd00', 'review')
            ->press('Add a Review')
            ->see('you aren\'t registered in this course');


            #->seeInSession('errormsg','you aren\'t registered in this course');



    }
}
