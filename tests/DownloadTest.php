<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class download_test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

  public function test1()
   {
    //InvalidArgumentException: Expecting a DOMNodeList or DOMNode instance, an array, a string, or null, but got "boolean"
      /*
      $this->visit('/course_description/2')
             ->click('ma')
             ->type('0170faf','reg_code')
             ->press('dnload')
             ->seeStatusCode(200);
          */   
             $r = $this->call('POST', '/course_description/2/download', ["reg_code"=>"0170faf"]);
              $this->assertEquals($r->getStatusCode(), 200);
              $this->assertSessionHas('msg', 'download successful');

   }
   

   public function test2()
   {
             $r = $this->call('POST', '/course_description/2/download', ["reg_code"=>""]);

              $this->assertEquals($r->getStatusCode(), 302);
   }

   public function test3()
   {
             $r = $this->call('POST', '/course_description/123/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   
   public function test4()
   {
             $r = $this->call('POST', '/course_description/2/download', ["reg_code"=>"44ad48e"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }

   public function test5()
   {
             $r = $this->call('POST', '/course_description/4/download', ["reg_code"=>"124"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   public function test6()
   {
             $r = $this->call('POST', '/course_description/3/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   public function test7()
   {
             $r = $this->call('POST', '/course_description/g/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   public function test8()
   {
             $r = $this->call('POST', '/course_description/0.5/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   public function test9()
   {
             $r = $this->call('POST', '/course_description//download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 404);
   }
   public function test10()
   {
             $r = $this->call('POST', '/course_description/-1/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   public function test11()
   {
             $r = $this->call('POST', '/course_description/0/download', ["reg_code"=>"123"]);
              $this->assertEquals($r->getStatusCode(), 302);
   }
   
}
