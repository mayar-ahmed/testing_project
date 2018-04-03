@extends('layouts.admin')
@section('title')
    Course Description
@stop
@section('header_files')
    <link rel="stylesheet" type="text/css" href="/css/course_description.css">
@stop

@section('content')

    <div class="container-fluid">
        <!--ADD YOUR CODE HERE -->
        <div class="container" >
            @if(Session::has('message'))
                <div class="alert alert-success">{{Session('message')}}</div>
            @endif
            <div class="row" style="padding-top: 20px;">



                <h3 class="coursename">{{$course->name}} </h3>


                <div class="col-md-8" >
                    <h4 id="rating" hidden style="text-align: center; ">{{$course->ratings->avg('value')}}</h4>
                    <div class="stars-outer" style="padding-left:0">
                        <div class="stars-inner" style="left:0"></div>
                    </div>
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;">
                        <div class="container">

                            <ul class="nav navbar-nav " >
                                <li><a href="#" id="de" >Details</a></li>
                                <li><a href="#" id="ob">Objective</a></li>
                                <li><a href="#" id="ou">Outline</a></li>
                                <li><a href="#" id= "ma">Material</a></li>

                            </ul>
                        </div>
                    </nav>
                    <div class="destext">
                        <div id="details">
                            <ul style="list-style-type: none;">
                                <li>Start Date: {{$course->start_date}}</li>
                                <li>End Date: {{$course->end_date}}</li>
                                <li>Registration Deadline: {{$course->registration_deadline}}</li>
                                <li>Hours: {{$course->hours}}</li>
                                <li>Fees: {{$course->fees}}</li>
                                <li>Target: {{$course->target}}</li>
                            </ul>
                        </div>
                        <div id="objectives" style="display: none;"> {{$course->objective}}</div>
                        <div id="outline" style="display: none;"><?php echo $course->outline ?></div>
                        <div id="material" style="display: none;">
                            @if(($course->material) != "")
                                <a href="/admin/downloadmaterial/{{$course->id}}">Course Material</a>
                            @else
                                {{'No material uploaded for this course'}}
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-2" >
                    <a href="/admin/courseregistrations/{{$course->id}}" class="butbut"><button type="submit" name="submit" class="btn btn-success ">View Course Registrations</button></a>

                    <a href="/admin/editcourse/{{$course->id}}" class="butbut"><button type="submit" name="submit" class="btn btn-success ">Edit</button></a>
                    <a href="/admin/deletecourse/{{$course->id}}"  class="butbut"><button type="submit" name="submit" class="btn btn-success "  onclick=" return confirm('Are you sure ?')">Delete</button></a>

                </div>
            </div>

            <div class="row">
                    <h2>Reviews</h2>

                    {{--<pre>--}}
                    {{--{{$course->reviews}}--}}
                    {{--</pre>--}}
                    @foreach($course->reviews as $rev)
                        <div class="panel panel-white post panel-shadow">
                            <div class="post-heading">

                                <div class="pull-left meta">
                                    <div class="title h5">
                                        <b>{{$rev->registrant_name}}</b>
                                    </div>
                                    <h6 class="text-muted time">{{$rev->date_time}}</h6>
                                </div>
                            </div>
                            <div class="post-description">
                                <p>{{$rev->review}}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#de").click(function(){
                $("#details").show();
                $("#objectives").hide();
                $("#outline").hide();
                $("#material").hide();
            });
            $("#ob").click(function(){
                $("#details").hide();
                $("#objectives").show();
                $("#outline").hide();
                $("#material").hide();
            });
            $("#ou").click(function(){
                $("#details").hide();
                $("#objectives").hide();
                $("#outline").show();
                $("#material").hide();
            });
            $("#ma").click(function(){
                $("#details").hide();
                $("#objectives").hide();
                $("#outline").hide();
                $("#material").show();
            });

            var rate= $('#rating').text();
            rate=Number(rate);
            var starPercentage = (rate / 5) * 100;
            // 3
            var starPercentageRounded = (Math.round(starPercentage / 10) * 10);

            $('.stars-inner').css('width',starPercentageRounded);

        });


    </script>
@stop