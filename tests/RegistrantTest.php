
<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class UserTest extends TestCase
{
    //old code ignore it


    use DatabaseTransactions;
    //to reset database state after each test

    /**
     * test registration function
     *
     * @return void
     */
    public function test1()
    {
        //logic and branch coverage on registartion function

        //test one: invalid input format
        $this->visit('/course_description/2')
            ->type('1234', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('1231231231231199', 'ssn')
            ->type('haram','address')
            ->type('mmm', 'phone_number')
            ->press('Submit')
            ->see('ssn should be 14 numbers only');

        //test 2:successful registration
        $this->visit('/course_description/2')
            ->type('mohamed', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('12312512312311', 'ssn')
            ->type('haram','address')
            ->type('01065518447', 'phone_number')
            ->press('Submit')
            ->see('Registration Successful');

        #check new user in database to confirm
        $this->seeInDatabase('registrants' ,['email' => 'mohamed@gmail.com']);

        #case3: different registrant exists in database with the same email
        $this->visit('/course_description/2')
            ->type('mohamed', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('12312382312311', 'ssn')
            ->type('haram','address')
            ->type('01063518447', 'phone_number')
            ->press('Submit')
            ->see('this email belongs to another ssn');

        #case4: registered in the same course
        $this->visit('/course_description/2')
            ->type('mohamed', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('12312512312311', 'ssn')
            ->type('haram','address')
            ->type('01065518447', 'phone_number')
            ->press('Submit')
            ->see('you are already registered to this course');


    }

    /**
     * logic and branch coverage for add review function
     *
     * @return void
     */

    public function test2(){



       #text case1 : empty review field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Add a Review')
            ->see('The review field is required');

        #test case 2: invalid course id -->redirect
       $resp=$this->call('POST', '/course_description/-1/addreview' ,['code'=>'222', 'review'=>'crap']);
       $this->assertRedirectedTo('http://localhost/course_description/2');


         #test case 3 : confirmed registrant
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('Review Added successfully');

        $this->seeInDatabase('reviews', ['review'=>'this course was great', 'course_id'=>2]);

       #test case 4: unconfirmed registrant
        $this->visit('/course_description/2')
            ->type('06e47c6', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('your registration isn\'t confirmed yet to add a review');

       #test case 5 : not registered in the course
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('you aren\'t registered in this course');



    }


    /**
     * logic and branch coverage for add rating function
     *
     * @return void
     */

    public function test3(){



        #text case1 : empty rating field
        $this->visit('/course_description/2')
            ->press('Rate')
            ->see('The rating field is required');

        #test case 2: invalid course id -->redirect back to current page
        $resp=$this->call('POST', '/course_description/-1/addrating' ,['code'=>'222', 'rating'=>'blabla']);
        $this->assertRedirectedTo('http://localhost/course_description/2');


        #test case 3 : confirmed registrant who hasn't rated  before
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('2.5', 'rating')
            ->press('Rate')
            ->see('Rating Added successfully');

        #test case 4: confirmed registrant rates again
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('3.5', 'rating')
            ->press('Rate')
            ->see('your already rated this course');


        #test case 5: unconfirmed registrant
        $this->visit('/course_description/2')
            ->type('06e47c6', 'code')
            ->type('2', 'rating')
            ->press('Rate')
            ->see('your registration isn\'t confirmed yet to rate');


        #test case 6 : not registered in the course
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->type('4', 'rating')
            ->press('Rate')
            ->see('you aren\'t registered in this course');

    }














}