<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact Us</title>
	<!-- COMMON CSS FILES -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!-- PAGE CSS FILE -->
    <link rel="stylesheet" href="/css/contact_us.css"/>
    <link rel="stylesheet" href="/css/home.css">

    <!-- COMMON JS FILES -->
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>

    <!-- PAGE JS FILE -->
    <script src="/js/all_courses.js"></script>
</head>
<body>
<!-- start of header -->

<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container-fluid our-style">
        <!-- <a class="navbar-brand our-s" href="">NUB Center</a> -->
        <form class="navbar-form navbar-left our-s" role="search" action="/search" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Search Course">
            </div>
            <button type="submit" name="submit" class="btn" id="btn-h"><span class="glyphicon glyphicon-search"></span></button>
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
<!-- end of header -->
<!-- contact details start -->
    <section id="content">
    <div class="container">
        <div class="row">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    <strong>{{ "Success!" }}</strong> {{ "Message submited." }}
                </div>
            @elseif((count($errors) > 0))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="col-sm-5">
            <div class="row">
                <div class="col-xs-12">
                <h1>Contact Details</h1>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-2 col-xs-3">
                <i class="fa fa-map-marker fa-5x primary-color"></i>
                </div>
                <div class="col-lg-10 col-xs-9">
                <h3 class="no-margin">Address </h3>
                    <h4>34 dokki street</h4>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12"><hr></div>
            </div>
            <div class="row">
            <div class="col-lg-2 col-xs-3">
                <i class="fa fa-phone fa-5x primary-color"></i>
                </div>
                <div class="col-lg-10 col-xs-9">
                <h3 class="no-margin">Phone & FAX</h3>
                    <h4>01066518 447</h4>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12"><hr></div>
            </div>
            <div class="row">
            <div class="col-lg-2 col-xs-3">
                <i class="fa fa-envelope fa-5x primary-color"></i>
                </div>
                <div class="col-lg-10 col-xs-9">
                <h3 class="no-margin"> Email</h3>
                    <h4>center@gmail.com</h4>
                </div>
            </div>
            </div>
            <div class="col-sm-7">

                {{--<img src="img/1446540339.jpg" class="img-responsive">--}}
            </div>
        </div>
        </div>
    </section>
    <!-- contact details end -->
    <!-- feedback form starts here -->
    <section id="contact" class="alt-background">
        <div class="container">
            <div class="row">


            <div class="col-sm-12 text-center">
                <h2>Send US A Message</h2>
                </div>
            </div>
     <form role="form" name="contact-form" id="contact-form" action="/feedback" method="post">
         {{csrf_field()}}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group required" id="contact-name-group">
                <label class="control-label" for="contact-input-name">Name</label>
                <input type="text" name="name" class="form-control" id="contact-input-name" placeholder="Name" value="{{ old('name') }}">
            </div>
           <div class="form-group required" id="contact-email-group">
                <label for="contact-input-email" class="control-label">Email</label>
                <input type="email" name="email" class="form-control" id="contact-input-email" placeholder="Email" value="{{ old('email') }}">
            </div>
        </div>
    <div class="col-sm-6">
        <div class="form-group required" id="contact-message-group">
            <label for="contact-input-message" class="control-label">Message</label>
            <textarea class="form-control" name="message" id="contact-input-message" rows="5" >{{ old('message') }}</textarea>
        </div>
        </div>
         </div>
         <div class="row">
         <div class="col-sm-12 text-center">
             <button type="submit" name="contactus" class="btn btn-success">Send</button>
             </div>
         </div>
    </form>
            </div>
    </section>
<!-- footer starts here -->
<footer class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 footer-para">
                <p>&copy;IgniteDesignweb.com All right reserved</p>
            </div>
            <div class="col-xs-6 text-right">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-skype"></i></a>
                <a href="http://www.nub.edu.eg/index.php"><i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>
    </footer>
    <!-- footer starts here -->
    
</body>
</html>