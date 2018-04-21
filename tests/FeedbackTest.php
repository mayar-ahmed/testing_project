<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class feedback_test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1()
    {
        $this->visit('/contactus')
            ->type('Ahmed','name')
            ->type('ahmed@yahoo.com','email')
            ->type('This is a message','message')
            ->press('contactus')
            ->see('Success');
    }

    public function test2()
    {
        $this->visit('/contactus')
            ->type('Ahmed','name')
            ->type('ahmed@com','email')
            ->type('This is a message','message')
            ->press('contactus')
            ->see('The email must be a valid email address');
    }
    
    public function test3()
    {
        $this->visit('/contactus')
            ->type('ahmed@yahoo.com','email')
            ->type('This is a message','message')
            ->press('contactus')
            ->see('name field is required');
    }
    public function test4()
    {
        $this->visit('/contactus')
            ->type('Ahmed123','name')
            ->type('ahmed@yahoo.com','email')
            ->type('This is a message','message')
            ->press('contactus')
            ->see('name format is invalid');
    }

    public function test5()
    {
        $this->visit('/contactus')
            ->type('Ahmed123','name')
            ->type('This is a message','message')
            ->press('contactus')
            ->see('email field is required');
    }
    public function test6()
    {
        $this->visit('/contactus')
            ->type('Ahmed123','name')
            ->type('ahmed@yahoo.com','email')
            ->press('contactus')
            ->see('message field is required');
    }
 
}
