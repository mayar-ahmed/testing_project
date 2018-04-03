<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/css/slick-theme.css"/>
    <link rel="stylesheet" href="/css/slick.css"/>
	<link rel="stylesheet" href="/css/home.css">
</head>
<body>
<!-- start of header -->
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container-fluid our-style">

        <form class="navbar-form navbar-left our-s" role="search" action="/search" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Search Course">
            </div>
            <button type="submit" name="submit" class="btn" id="btn-h"><span class="glyphicon glyphicon-search"></span></button>
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    <p style="color:white;">{{$error}}</p>
                @endforeach
            @endif
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
                <li><a href="#about">About Us</a></li>
                <li><a href="/contactus">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- end of header -->
    
<!-- start of slider section -->
<section id="home">
    <div class="container-fluid">
        <div class="row">
                <div class="header-backup"></div>

                    <div class="item" style="overflow: hidden;">
                        <img src="img/slide-four.jpg">
                        <div class="carousel-caption">
                            <h1>Best Training</h1>
                        </div>
                    </div>
        </div>
    </div>
    </section>
    <!-- end of slider section -->

<!-- start of about section -->
    <section class="about text-center" id="about">
        <div class="container">
            <div class="row">
                <h2>about us</h2>
                <h4>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</h4>
                <div class="col-md-4 col-sm-6">
                    <div class="single-about-detail clearfix">

                        <div class="about-details">
                            <h3>Our vision</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-about-detail">
                        <div class="about-details">
                            <h3>Our mission</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-about-detail">
                        <div class="about-details">
                            <h3>Our History</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of about section -->

<!-- latest courses section starts here -->
    <section class="service text-center" id="service">
        <div class="container">
            <div class="row">
                <h2>Latest Courses</h2>
               <div id="wrap_latest">
                    @foreach($courses as $course)
                    <div class="single-service">
                        <div class="service_name">
                            <h3>{{$course->name}}</h3>
                        </div>
                        <div class="single-service-info">
                            <h4><span class="service_title">Course Objective:</span><br>{{$course->objective}}</h4>
                            <h4><span class="service_title">Start Date:</span> {{$course->start_date}}</h4>
                            <h4><span class="service_title">Fees:</span> {{$course->fees}}</h4>
                            <a class="read_more" href="/course_description/{{$course->id}}">Read More</a>
                        </div>

                    </div>

                   @endforeach

               </div>
            </div>
        </div>
    </section>
    <!-- end of latest courses section -->

<!-- footer starts here -->
<footer class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 footer-para">
                <p>All right reserved</p>
            </div>
            <div class="col-xs-6 text-right">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-skype"></i></a>
                <a href="#"><i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>
    </footer>
    <!-- footer starts here -->
    
    <!-- script tags
	============================================================= -->
	<script src="/js/jquery-2.1.1.js"></script>
	<script src="/js/smoothscroll.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/slick.min.js"></script>
	<script src="/js/custom.js"></script>

</body>
</html>