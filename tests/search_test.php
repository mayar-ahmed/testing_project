<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class search_test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1_search()
    {
    	$this->visit('/')
    		->type('management','name')
    		 ->press('submit')
             ->see('Search Results')
             ->see('Management');
    }
    
    public function test2_search()
    {
    	$this->visit('/')
    		 ->press('submit')
             ->see('The name field is required');
    }

}
