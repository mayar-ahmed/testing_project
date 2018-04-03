<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //get home page
    public function index()
    {
        $courses = Course::orderBy('created_at','desc')->take(5)->get();
        return view('public.home',compact('courses'));
    }

    //get contact us page
    public function contact()
    {
        return view('public.contact_us');
    }




//    //
//    public function search($name){
//        $courses=Course::where('name','like',"%$name%")->get();
//        $category=null;
//        return view('public.courses',compact('courses','category'));
//    }

}
