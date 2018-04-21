<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class registration_test extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    //white box testing for registartion function
    //logic and branch coverage
    public function test1()
    {
        //test one: invalid input format

        $this->visit('/course_description/2')
            ->type('1234', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('1231231231231199', 'ssn')
            ->type('haram','address')
            ->type('mmm', 'phone_number')
            ->press('Submit')
            ->see('ssn should be 14 numbers only');
    }




    public function test2()
    { //test 2:successful registration

        $this->visit('/course_description/2')
            ->type('mohamed', 'name')
            ->type('mohamed@gmail.com', 'email')
            ->type('12312512312311', 'ssn')
            ->type('haram','address')
            ->type('01065518447', 'phone_number')
            ->press('Submit')
            ->see('Registration Successful');

        //check new user in database to confirm
        $this->seeInDatabase('registrants' ,['email' => 'mohamed@gmail.com']);

    }

    public function test3(){
        #test case3: different registrant exists in database with the same email

        $this->visit('/course_description/2')
            ->type('mohamed', 'name')
            ->type('salma@gmail.com', 'email')
            ->type('12312382312511', 'ssn')
            ->type('haram','address')
            ->type('01063518447', 'phone_number')
            ->press('Submit')
            ->see('this email belongs to another ssn');

    }

    public function test4(){
        #test case4: registered in the same course

        $this->visit('/course_description/2')
            ->type('salma', 'name')
            ->type('salma@gmail.com', 'email')
            ->type('12312312312311', 'ssn')
            ->type('haram','address')
            ->type('01065518447', 'phone_number')
            ->press('Submit')
            ->see('you are already registered to this course');
    }

    /////////////////////////////////////////////////////////////////////////////////////////

}
