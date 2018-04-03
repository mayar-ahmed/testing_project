@extends('layouts.admin')
@section('title')
    Courses
@stop
@section('header_files')
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
@stop

@section('content')
        <div class="container-fluid">

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session('message')}}</div>
            @endif
            @if($courses->isEmpty())
              <h3>{{"No Courses Found"}}</h3>
            @else
        <div class="row">

            <div class="col-md-12">

                <ul style="list-style-type: none; padding-top: 50px; ">
                    <li> <h3>{{ucfirst($category->name)}}</h3></li>

                    @foreach ($courses as $course)
                        <li class="listitem">

                         <h1>{{$course->name}}</h1>

                            @if($course->registration_deadline <= date("Y-m-d"))
                            <p class="available"> Unvailable now</p>
                            @else
                            <p class="available"> Available now</p>
                            @endif

                         <p class="hours"> Hours: {{$course->hours}}</p> <p class="price">Fees: {{$course->fees}}</p>
                     <a href="/admin/editcourse/{{$course->id}}" class="butbut"><button type="submit" name="submit" class="btn btn-success ">Edit</button></a>
                            <a href="/admin/deletecourse/{{$course->id}}"  class="butbut"><button type="submit" name="submit" class="btn btn-success "  onclick=" return confirm('Are you sure ?')">Delete</button></a>
                         <hr/>
                         <p class="obj"> Course Objectives</p>
                         <p class="objdes"> {{$course->objective}}
                         <br><a href="/admin/course_description/{{$course->id}}"> Read More</a>
                         </p>

                            </li>
            @endforeach
                </ul>
            </div>
        </div>
                @endif

        </div>
@stop
