<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrantBlackBox extends TestCase
{
    use DatabaseTransactions;

    //old code ignore it


    /**
     * logic coverage on registration function
     *
     * @return void
     */

    public function test1(){

        //need to separatae test cases as method stops on first failure, but tested each one indvidually
        #test case 1 : all valid inputs
        $this->visit('/course_description/3')
            ->type('omar ahmed', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('Registration Successful');


        #test case 2 : empty name
        $this->visit('/course_description/3')
            ->type('', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name field is required');

        #test case 3 : empty email
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The email field is required');

        #test case 4 : empty ssn
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn field is required');

        #test case 5 : empty address
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The address field is required');

        #test case 6: empty phone number
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('mayar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('', 'phone_number')
            ->press('Submit')
            ->see('The phone number field is required');

        #test case 7: numeric name
        $this->visit('/course_description/3')
            ->type('1234dd', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name format is invalid');

        #test case 8: name >100 chars
        $this->visit('/course_description/3')
            ->type('mayar ahmed mahmoud hefny mostafa hassan kareem mayar nahla ahmed maya maya kareem ahmed mahmoud hefny msostafa', 'name')
            ->type('omar@gmail.com', 'email')
            ->type('1231231289231199', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The name may not be greater than 100 characters');


        #test case 9: ssn length <14 :failed
        $this->visit('/course_description/4')
            ->type('omar', 'name')
            ->type('omarahmed@gmail.com', 'email')
            ->type('12923', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn must be 14 characters');

        #test case 10: phone number length >11 :failed
        $this->visit('/course_description/5')
            ->type('omar', 'name')
            ->type('omarahmedmahmoud@gmail.com', 'email')
            ->type('01282340938883', 'ssn')
            ->type('haram','address')
            ->type('0128234093888553', 'phone_number')
            ->press('Submit')
            ->see('The phone number must be 11 characters');

        #test case 11: phone number length >11
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmdmahmoud@gmail.com', 'email')
            ->type('bla bla', 'ssn')
            ->type('haram','address')
            ->type('01282340938', 'phone_number')
            ->press('Submit')
            ->see('The ssn must be a number');

        #test case 12: phone number not numeric
        $this->visit('/course_description/3')
            ->type('omar', 'name')
            ->type('omarahmdmah@gmail.com', 'email')
            ->type('01282340938', 'ssn')
            ->type('haram','address')
            ->type('01mama', 'phone_number')
            ->press('Submit')
            ->see('The phone number must be a number');


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


    /**
     * logic coverage for add review function
     *
     * @return void
     */

    public function test2(){


        #text case1 : empty review field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Add a Review')
            ->see('The review field is required');


        #text case1 : empty code field
        $this->visit('/course_description/2')
            ->type('this is so great', 'review')
            ->press('Add a Review')
            ->see('The code field is required');


        #test case 3 : confirmed registrant
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('this course was great', 'review')
            ->press('Add a Review')
            ->see('Review Added successfully');



    }

    /**
     * logic coverage for add rating function
     *
     * @return void
     */

    public function test3()
    {


        #text case1 : empty rating field
        $this->visit('/course_description/2')
            ->type('12345', 'code')
            ->press('Rate')
            ->see('The rating field is required');

        #text case2 : empty code field
        $this->visit('/course_description/2')
            ->type('2.5', 'rating')
            ->press('Rate')
            ->see('The code field is required');

        #test case 3 : confirmed registrant who hasn't rated  before
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('2.5', 'rating')
            ->press('Rate')
            ->see('Rating Added successfully');

        #test case 4: rating must be a number
        $this->visit('/course_description/2')
            ->type('e39d565', 'code')
            ->type('mmm', 'rating')
            ->press('Rate')
            ->see('The rating must be a number');

    }



    }
