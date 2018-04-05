<?php

namespace App\Http\Controllers;

use App\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Http\Requests;
use App\Course;
use App\Category;


class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'searchAdmin', 'deleteCourse','deleteRegistration', 'downloadAdmin']);
    }


    #search for a certain course
    public function searchPublic(Request $request)
    {
        $rules = array(
            'name' => 'required',
        );
        $this->validate($request, $rules);
        $name=$request->all()['name'];

        $courses=Course::where('name','like',"%$name%")->get();
        $category=null;
        return view('public.courses',compact('courses','category'));


    }


    #get all courses in a category
    public function CCoursesByCategory($category){
        $courses=Course::where('category_id',$category)->orderBy('name', 'asc')->get();
        return view('public.courses',['courses' => $courses, 'category'=>Category::find($category)]);
    }


    #get details of a certain course
    public function CCourseDescription($courseID){
        $course=Course::find($courseID);
        return view('public.course_description',compact('course'));
    }



    #download course materials
    public function download(Request $req, $courseID)
    {
       
        $this->validate($req,[
    		'reg_code' => 'required']);
        
        $course = Course::find($courseID);
        
         if(!empty($course))
         {

             $registration = DB::table('course_registrant')->where('course_id',$courseID)->get();

             foreach($registration as $reg)
             {
                 if (Hash::check($req->reg_code,$reg->code))
                 {
//                     if (Hash::needsRehash($reg->code))
//                     {
//                         $hashed = Hash::make($req->reg_code);
//                     }
                     if(!$reg->confirmed){
                         return redirect()->back()->with('errormsg',"your registration isn't confirmed yet");
                     }
                     Session::flash('msg', 'download successful');
                     return response()->download($course->material);
                 }

             }

             Session::flash('errormsg', "you aren't registered in this course");
             return redirect()->back()->withInput();

         }
        else
        {
            return redirect()->back();
        }
      
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //admin fucntionality

    public function addCourse(Request $req){


        //validate form input
        $this->validate($req ,[
            'name'=>'required|max:100',
            'category_id'=>'required',
            'fees'=>'required|numeric|min:0',
            'hours'=>'required|int|min:0',
            'max_registrants'=>'required|int|min:0',
            'min_registrants'=>'required|int|min:0',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'registration_deadline'=>'required|date',
            'objective'=>'required',
            'target'=>'required',
            'outline'=>'required',
            'material'=>'mimes:rar'
        ]);

        //save file
        $filepath="";
        if($req->hasfile('material')){
            $file=$req->file('material');
            //5 kb
            if ($file->isValid() &&  $file->getSize() < 5242880 ) {
                $filename=$req->name.rand(1,1000).".rar";
                $destinationPath='../resources/files';
                $file->move($destinationPath, $filename);
                $filepath=$destinationPath."/".$filename;
            }else{
                //flash message and input to session and return back
                return redirect('/admin/addcourse')->with('file_error','The File Size is too large')->withInput();

            }

        }

        $course=new Course($req->all());
        $course->material=$filepath;
        $course->save();

        return redirect()->action('AdminController@ACourseDescription', [$course->id])->with('message', 'Course Added Successfully');

    }


    public function editCourse(Request $request , Course $course)
    {
        $this->validate($request ,[
            'name'=>'required|max:100',
            'category_id'=>'required',
            'fees'=>'required|numeric|' ,
            'hours'=>'required|int|min:0',
            'max_registrants'=>'required|int|min:0',
            'min_registrants'=>'required|int|min:0',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'registration_deadline'=>'required|date',
            'objective'=>'required',
            'target'=>'required',
            'outline'=>'required',
            'material'=>'mimes:rar'
        ]);

        $filepath=$course->material;
        if($request->hasfile('material')){
            $file=$request->file('material');

            if ($file->isValid() &&  $file->getSize() < 5242880 ) {
                $filename=$request->name.rand(1,1000).".rar";
                $destinationPath='../resources/files';
                $file->move($destinationPath, $filename);
                $filepath=$destinationPath."/".$filename;
            }else{
                //flash message and input to session and return back

                return redirect()->back()->with('file_error','The File Size is too large')->withInput();

            }
        }

        $course->update($request->all());
        $course->material=$filepath;
        $course->save();


        return redirect()->action('AdminController@ACourseDescription', [$course->id])->with('message', 'Course Edited Successfully');


    }

    public function searchAdmin (Request $request)
    {
        $rules = array(
            'name' => 'required',
            'category_id' => 'required',
        );
        $this->validate($request, $rules);

        $param1=$request->all()['name'];
        $param2= $request->all()['category_id'];

        return redirect()->action('AdminController@searchCourse',[$param2,$param1]);

    }

    public function deleteCourse($course_id)
    {
        $course=Course::find($course_id);

        if(!empty($course))
        {
            $cat= $course->category_id;
            Course::where('id' , $course_id)->delete();
            return redirect()->action('AdminController@ACoursesByCategory',[$cat])->with('message','Course Deleted Successfully');
        }
        else
            return redirect()->back();

    }

    public function courseRegistrations ($course_id)
    {
        $course=Course::find($course_id);
        if($course != null)
        {

            $registrants = $course->registrants;
            return view('administrator.course_registrations',compact('registrants','course'));
        }
        else{
            return redirect()->back();
        }

    }

    public function deleteRegistration($course_id , $reg_id)
    {
        $course=Course::find($course_id);
        $reg=Registrant::where('ssn',$reg_id)->first();
        if($course != null && $reg!=null)
        {
            $course->registrants()->detach($reg->ssn);
            return redirect()->back()->with('message', 'registration cancelled successfully');
        }
        else{
            return redirect()->back();
        }

    }

    public function downloadAdmin($courseID){
        $course = Course::find($courseID);
        if (!empty($course)){
            return response()->download($course->material);
        }else{
            return redirect()->back();

        }

    }

}


