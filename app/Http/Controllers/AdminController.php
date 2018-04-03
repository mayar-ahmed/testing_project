<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Category;
use App\Course;
use App\Message;
use App\Registrant;
use App\Http\Requests;

use DB;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCoursePage(){
        $categories=Category::all();
        return view('administrator.add_course', compact('categories'));
    }

    public function editCoursePage($course_id)
    {
        $course = Course::find($course_id);
        $categories = Category::all();

        return view('administrator.edit_course', compact(['course', 'categories']));

    }

    public function singleRegistrant( $reg_id){
        $reg=Registrant::where('ssn',$reg_id)->first();
        return view('administrator.registrant',compact('reg'));
    }

    public function messages()
    {
    	$messages = DB::table('messages')
                    ->orderBy('created_at', 'desc')
                    ->get();

    	return view('administrator.messages',compact('messages'));
    }


    public function index()
    {
    	return view('administrator.home');
    }

    public function searchCourse(Category $category,$name)
    {
        $courses = $category->courses()->where('name','like', "%$name%")->get();
        return view('administrator.all_courses',compact('courses','category'));
    }

    public function ACoursesByCategory($category){
        $courses=Course::where('category_id',$category)->orderBy('name', 'asc')->get();
        return view('administrator.all_courses',['courses' => $courses , 'category'=>Category::find($category)]);
    }

    public function ACourseDescription($courseID){
        $course=Course::find($courseID);
        return view('administrator.course', compact('course'));
    }

    public function latestRegistrations()
    {
        $registrations = DB::table('course_registrant')->orderBy('date_time', 'desc')->get();

        return view('administrator.latest_registrations', compact('registrations'));

    }

    public function logout()
    {
        \Auth::logout();
        return \Redirect::to('/admin');
    }
    

}
