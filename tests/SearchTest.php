<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTes extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1()
    {
    	$this->visit('/')
    		->type('management','name')
    		 ->press('submit')
             ->see('Search Results')
             ->see('Management');
    }
    
    public function test2()
    {
    	$this->visit('/')
    		 ->press('submit')
             ->seePageIs('/')
             ->see('The name field is required');
    }

}
