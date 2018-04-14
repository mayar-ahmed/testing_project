
<!DOCTYPE html>
<html>

<head>
    <title>Course Description</title>
    <meta charset="UTF-8">

    <!-- COMMON CSS FILES -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">


    <!-- PAGE CSS FILE -->
    <link rel="stylesheet" href="/css/simple-sidebar.css"/>

    <link rel="stylesheet" type="text/css" href="/css/course_description.css">
    <link rel="stylesheet" type="text/css" href="/css/home_nav.css">





    <!-- COMMON JS FILES -->
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>
<body style="background-color: #f1f1f1;">

<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container-fluid our-style">
        <!-- <a class="navbar-brand our-s" href="">NUB Center</a> -->
        <form class="navbar-form navbar-left our-s" role="search" action="/search" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Search Course">
            </div>
            <input type="submit" value="search">
<!--            <button type="submit" name="submit" value='search' class="btn" id="btn-h"><span class="glyphicon glyphicon-search"></span></button>-->

        </form>

        <div class="navbar-header navbar-right our-s">
            <ul class="nav navbar-nav ">
                <li><a href="/">Home</a></li>
                <li class="dropdown s">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
                    <ul class="dropdown-menu s">
                        <?php $categories=App\Category::all() ?>
                        @foreach($categories as $category)
                            <li><a href="/courses/{{$category->id}}"> {{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/contactus">Contact US</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container m" >
    <div class="row" style="padding-top: 20px;">

        <h4 id="rating" hidden style="text-align: center;">{{$course->ratings->avg('value')}}</h4>
        <h3 class="coursename" style="text-align: center;">{{$course->name}} </h3>
        <div class="stars-outer pub" style="text-align: center;">
            <div class="stars-inner"></div>
        </div>
        <br><br>

        @if (Session::has('msg'))
            <div class="alert alert-success"> {{Session('msg')}} </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        @if (Session::has('errormsg'))
            <div class="alert alert-danger"> {{Session('errormsg')}} </div>
        @endif


        <div class="col-md-3 form2">

            @if(($course->registration_deadline > date("Y-m-d")) || ($course->registrants()->count() < $course->max_registrants))


                <div class="container">


                    <form method="post" role="form" action="/registeration/{{$course->id}}"  enctype="multipart/form-data" >
                        {{csrf_field()}}

                        <div class="col-md-3 formcontainer" >

                            <h2 style="text-align: center;">Registration</h2>
                            <div class="form-group required">

                                <label for="name">Name</label>
                                <input type="text" class="form-control " name="name" value="{{old('name')}}" required >
                            </div>

                            <div class="form-group required" >

                                <label for="email">Email</label>
                                <input type="email" class="form-control " name="email" value="{{old('email')}}" required>
                            </div>

                            <div class="form-group required">

                                <label for="name">National ID</label>
                                <input type="text" class="form-control " minlength="14" maxlength="14" value="{{old('ssn')}}" name="ssn" required >
                            </div>


                            <div class="form-group required">

                                <label for="name">Address</label>
                                <input type="text" class="form-control " name="address" value="{{old('address')}}" required >

                            </div>
                            <div class="form-group required">

                                <label for="name">Phone number</label>
                                <input type="text" class="form-control " minlength="11" maxlength="11" name="phone_number" value="{{old('phone_number')}}" required >
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-default buttonn text-center" name="submit" value="Submit"></div>
                        </div>
                    </form>
                </div>

            @else
                <div style="height: 500px;"> <h2 style="text-align: center;">Registration Closed</h2></div>
            @endif
        </div>

        <div class="col-md-8" >



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
                <div id="outline" style="display: none;"> <?php echo $course->outline ;?></div>
                <div id="material" style="display: none;">
                    @if(($course->material) != "")
                        <form  class="form-inline"  method="POST" action="/course_description/{{$course->id}}/download">
                            {{csrf_field()}}
                            <div class="form-group" >
                                <input type="text" class="form-control" placeholder="Enter your code" name = "reg_code" maxlength="10" value="{{old('reg_code')}}" >
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Download</button>
                        </form>
                    @else
                        {{'Course material not available yet'}}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <br>
            <form   class="form-inline"method="POST" action="/course_description/{{$course->id}}/addrating">
                {{csrf_field()}}
                <div class="form-group" >
                    <input type="text" class="form-control" placeholder="Enter your code " name = "code" maxlength="10" value="{{old('code')}}" >
                </div>
                
                <div class="form-group" id="rating">
                  <span>★</span>
                  <span>★</span>
                  <span>★</span>
                  <span>★</span>
                  <span>★</span>
                </div>

                <div>
                    <input type="text" id="r" class="form-control" placeholder="Enter your rating " name = "rating" maxlength="5" value="{{old('code')}}" >
                </div>

                <button type="submit" name="submitrate" class="btn btn-success">Rate</button>

            </form>
        </div>
        <div class="col-md-8">
            <br>
            <form   method="POST" action="/course_description/{{$course->id}}/addreview">
                {{csrf_field()}}
                <div class="form-group" >
                    <input type="text" class="form-control" placeholder="Enter your code " name = "code" maxlength="10" value="{{old('code')}}" >
                </div>
                <div class="form-group">
                    <textarea placeholder="review the course" class="rev" cols="73" rows="3" name="review" required value="{{old('review')}}"></textarea>

                </div>
                <button type="submit" name="submit" class="btn btn-success">Add a Review</button>
            </form>

            <br>

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

<footer class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 footer-para">
                <p> All right reserved</p>
            </div>
            <div class="col-xs-6 text-right">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-skype"></i></a>
                <a href=#"><i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>
</footer>



</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById('r').style.display = 'none';
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

        function fillUpTo(j){
        console.log(j);
        var stars = document.querySelectorAll('#rating span');

        if(j==-1 && stars[0].getAttribute('checked')==0)
        {
            for(var i=0;i<5;i++){
                stars[i].setAttribute('checked', 0);
                stars[i].classList.remove('hover');
            }
            return;
        }
        for(var i=0;i<j;i++){
            if (stars[i].getAttribute('val') > stars[j-1].getAttribute('val')) {
                stars[i].classList.remove('hover');
            }else {
        stars[i].classList.add('hover');
                }
         }

        }
        
        function setChecked(j){
            var stars = document.querySelectorAll('#rating span');
            k=0;
            for(i=0;i<j;i++){
                k++;
                stars[i].setAttribute('checked',1)
            }
            console.log("Rate:");
            console.log(k);
            document.getElementById('r').value=k;

        }

        function unsetChecked(){
            var stars = document.querySelectorAll('#rating span');
            for(i=0;i<5;i++){
                stars[i].setAttribute('checked',0)
            }

        }
        
       var rate= $('#rating').text();
        rate=Number(rate);
       var starPercentage = (rate / 5) * 100;
        // 3
        var starPercentageRounded = (Math.round(starPercentage / 10) * 10);

       $('.stars-inner').css('width',starPercentageRounded);
        

    var stars = document.querySelectorAll('#rating span');

      for (var i = 0; i <stars.length; i++) {
        stars[i].setAttribute('checked', 0);
        stars[i].setAttribute('val', i+1);
        stars[i].addEventListener('mouseenter',function(){
            unsetChecked();
            fillUpTo(parseInt(this.getAttribute('val')));
        });

        stars[i].addEventListener('mouseleave',function(){
            console.log("Mouse Leaving Event");
            fillUpTo(-1);
        });

        stars[i].addEventListener('click',function(){
            console.log("Mouse click Event");
            setChecked(parseInt(this.getAttribute('val')));
        });


        }
        //stars[i].addEventListener('mouseleave',function(){
        //console.log("Mouse Leaving Event");
      //});
        


      


    });


</script>
