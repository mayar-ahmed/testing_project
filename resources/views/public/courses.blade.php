 <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">


    <!-- PAGE CSS FILE -->
    <link rel="stylesheet" href="/css/simple-sidebar.css"/>
	<link rel="stylesheet" type="text/css" href="/css/courses.css">
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
						@foreach($categories as $cat)
							<li><a href="/courses/{{$cat->id}}"> {{$cat->name}}</a></li>
						@endforeach
					</ul>
				</li>
				<li><a href="/contactus">Contact US</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="row">

</div>
<div class="container m">
	@if($courses->isEmpty())

		<h2 class="noresults">No Courses Found</h2>

	@else
<div class="row">

	<div class="col-md-8 col-md-offset-2">
		<ul style="list-style-type: none; padding-top: 50px; ">
			@if($category!=null)
			<li> <h3>{{ucfirst($category->name)}}</h3></li>
			@else
					<li> <h3>Search Results</h3></li>
			@endif
@foreach ($courses as $course)
			@if(count($courses)==1)
						<li class="listitem" style="margin-bottom:390px;">
					@else
			<li class="listitem">
			@endif
			 <h1>{{$course->name}}</h1> 

@if($course->registration_deadline <= date("Y-m-d"))
<p class="available"> Unvailable now</p>
@else
<p class="available"> Available now</p>
@endif

			 <p class="hours"> Hours: {{$course->hours}}</p> <p class="price">Fees: {{$course->fees}}</p>
			 <hr/>
			 <p class="obj"> Course Objectives</p>
			 <p class="objdes"> {{$course->objective}} 
			 <br><a href="../course_description/{{$course->id}}"> Read More</a>
			 </p>
			</li>
@endforeach
		</ul>
	</div>
</div>
		@endif
</div>

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

</body>
</html>