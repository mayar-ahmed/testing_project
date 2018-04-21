<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class registration_bbtest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    //black box testing for registartion function

    //logic covergae on input specifications

    public function test1(){
        #test case 1 : all valid inputs
        $this->visit('/course_description/3')
            ->type('omar ahmed', 'name')
            ->type('omar23@gmail.com', 'email')
            ->type('1231291289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('Registration Successful');
    }

    public function test2(){
        #test case 2 : empty name
        $this->visit('/course_description/3')
            ->type('', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name field is required');
    }

    public function test3(){
        #test case 3 : empty email
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The email field is required');
    }

    public function test4(){
        #test case 4 : empty ssn
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn field is required');
    }
    public function test5(){
        #test case 5 : empty address
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The address field is required');

    }

    public function test6(){
        #test case 6: empty phone number
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('', 'phone_number')
            ->press('Submit')
            ->see('The phone number field is required');
    }

    public function test7(){
        #test case 7: numeric name
        $this->visit('/course_description/3')
            ->type('1234dd', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name format is invalid');

    }

    public function test8(){
        #test case 8: name >100 chars
        $this->visit('/course_description/3')
            ->type('mayar ahmed mahmoud hefny mostafa hassan kareem mayar nahla ahmed maya maya kareem ahmed mahmoud hefny msostafa', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name may not be greater than 100 characters');

    }

    //failure
    public function test9(){
        #test case 9: ssn length <14 :failed
        $this->visit('/course_description/4')
            ->type('omar', 'name')
            ->type('omarahmed@gmail.com', 'email')
            ->type('12923', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn must be 14 characters');
    }

    //failure
    public function test10(){
        #test case 10: phone number length >11 :failed
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmedmahmoud@gmail.com', 'email')
            ->type('01282340938883', 'ssn')
            ->type('haram','address')
            ->type('0128234093888553', 'phone_number')
            ->press('Submit')
            ->see('The phone number must be 11 characters');
    }


    public function test11(){
        #test case 11: ssn is not a number
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmdmahmoud@gmail.com', 'email')
            ->type('bla bla', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn must be a number');
    }

    public function test12(){
        #test case 12: phone number not numeric
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmdmah@gmail.com', 'email')
            ->type('01282340938', 'ssn')
            ->type('haram','address')
            ->type('01mama', 'phone_number')
            ->press('Submit')
            ->see('The phone number must be a number');
    }

    public function test13(){
        #test case 13: email not valid
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmdmahgmailm', 'email')
            ->type('01282340938', 'ssn')
            ->type('haram','address')
            ->type('01066518447', 'phone_number')
            ->press('Submit')
            ->see('The email must be a valid email address');
    }


    //failure --
    public function test14(){
        //test case 14: course id is not an integer (character)
        $resp=$this->call('POST', '/registeration/c' ,['name'=>'omar','email'=>'omar@gmail.com' , 'ssn'=>'12312312312311',
            'address'=>'haram' , 'phone_number'=>'01066518447']);

//        echo $resp->getContent();
        $this->assertRedirectedTo('http://localhost/');

    }

    //failure
    public function test15(){
        //test case 14: negative course id
        $resp=$this->call('POST', '/registeration/-1' ,['name'=>'omar','email'=>'omar@gmail.com' , 'ssn'=>'12312312312311',
            'address'=>'haram' , 'phone_number'=>'01066518447']);

//        echo $resp->getContent();
        $this->assertRedirectedTo('http://localhost');

    }



    //input space partitioning additional two cases

    //failure
    public function test16(){
        #test case 9: ssn length >14 :failed
        $this->visit('/course_description/4')
            ->type('omar', 'name')
            ->type('omarahmed@gmail.com', 'email')
            ->type('1292323451234123', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn must be 14 characters');
    }

    //failure
    public function test17(){
        #test case 10: phone number length <11 :failed
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmedmahmoud@gmail.com', 'email')
            ->type('01282340938883', 'ssn')
            ->type('haram','address')
            ->type('01282343', 'phone_number')
            ->press('Submit')
            ->see('The phone number must be 11 characters');
    }



}

