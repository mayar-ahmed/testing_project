@extends('layouts.admin')

@section('title')
    Add Course
@stop
@section('header_files')
    <link rel="stylesheet" type="text/css" href="/css/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/ckeditor/contents.css">
    <link rel="stylesheet" href="/css/admin_addcourse.css"/>

    <script src="/js/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckeditor/styles.js"></script>
    <script src="/js/add_course.js"></script>
@stop


@section('content')

       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12 ">

                   @if (Session::has('file_error'))
                       <div class="alert alert-danger">
                           <ul>
                               <li>{{Session('file_error')}}</li>
                           </ul>
                       </div>
                   @endif

                   <div class="panel panel-default">
                       <div class="panel-body">
                           <div class="title">
                               <h3>Add Course</h3>
                           </div>


                           <form method="post" enctype="multipart/form-data" action="/addcourse">
                               {{csrf_field()}}
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group required">
                                       <label for="name">Course Name </label>
                                           <input type="text" class="form-control" name="name" placeholder="Course Name" value="{{old('name')}}" />
                                       </div>
                                       <div class="form-group required">
                                       <label for="category_id">Course Category </label>
                                           <select class="form-control" name="category_id" value="{{old('category_id')}}">
                                               <option value="">Select A Category</option>
                                               @foreach($categories as $category)
                                                   <option value="{{$category->id}}">{{$category->name}}</option>
                                               @endforeach


                                           </select>
                                       </div>
                                       <div class="form-group required">
                                           <label for="fees">Course Fees</label>
                                           <input type="text" class="form-control" name="fees" placeholder="Price" value="{{old('fees')}}" />
                                       </div>

                                       <div class="form-group required">
                                           <label for="hours">Hours</label>
                                           <input type="text" class="form-control" name="hours" placeholder="Hours" value="{{old('hours')}}" />
                                       </div>

                                       <div class="form-group required">
                                           <label for="max_registrants">Maximum Registrants</label>
                                           <input type="text" class="form-control" name="max_registrants" placeholder="Maximum registrants" value="{{old('max_registrants')}}" />
                                       </div>

                                       <div class="form-group required">
                                           <label for="min_regstrants">Minimum Registrants</label>
                                           <input type="text" class="form-control" name="min_registrants" placeholder="Minimum registrants" value="{{old('min_registrants')}}" />
                                       </div>


                                       <div class="form-group required">
                                           <label for=start_date">Start Date</label>
                                           <input type="text" class="form-control date" name="start_date" placeholder="Start Date" value="{{old('start_date')}}"/>
                                       </div>

                                       <div class="form-group required">
                                           <label for=start_date">End Date</label>
                                           <input type="text" class="form-control date" name="end_date" placeholder="End Date" value="{{old('end_date')}}"/>
                                       </div>

                                       <div class="form-group required">
                                           <label for="registration_deadline">Registration Deadline</label>
                                           <input type="text" class="form-control date" name="registration_deadline" placeholder="Registration Deadline" value="{{old('registration_deadline')}}"/>
                                       </div>

                                   </div>

                                   <div class="col-md-6 ">

                                       <div class="input-group">
                                           <label for="material"> Course Material (.rar)&nbsp; </label>
                                        <span class="btn btn-default btn-file">
                                            Browse <input type="file" name="material" value="{{old('material')}}" />
                                            <input type="text" value="no file selected"  readonly>
                                        </span>

                                       </div>
                                       <br />


                                       <div class="form-group required">
                                           <label for="objective">Course Objective</label>
                                           <textarea rows="6" class="form-control" name="objective" placeholder="Course Objective">{{old('objective')}}</textarea>
                                       </div>

                                       <div class="form-group required">
                                           <label for="target">Course Target</label>
                                           <textarea rows="5" class="form-control" name="target" placeholder="Target Audience" >{{old('target')}}</textarea>
                                       </div>

                                   </div>
                               </div>

                               <div class="row">
                                   <div class="col-md-10 ">
                                       <div class="form-group required">
                                           <label for="editor1">Course Outline</label>
                                    <textarea name="outline" rows="50" cols="80">{{old('outline')}}
                                    </textarea>
                                       </div>
                                   </div>


                               </div>

                               <input type="submit" name="submit" value="Add" class="btn btn-success btn-lg" />




                           </form>
                       </div>
                   </div>
               </div>
           </div>


       </div>

@stop
