<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">

    <!-- COMMON CSS FILES -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="/text/css" href="/css/fonts.css">

    <!-- PAGE CSS FILE -->
    <link rel="stylesheet" href="/css/simple-sidebar.css"/>
    <link rel="stylesheet" href="/css/admin.css"/>




    <!-- COMMON JS FILES -->
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- PAGE JS FILE -->
    <script src="/js/admin_nav.js"></script>

    @yield('header_files')

</head>

<body>
<div id="wrapper">
    <!--sidebar-->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li>
                <a href="/admin">Home</a>
            </li>

            <li>
                <a href="#toggle_courses" id="toggle_courses">Courses
                </a>
                <?php $categories= App\Category::all();?>
                <ul id="course_cat">
                    @foreach ($categories as $cat)
                    <li><a href="/admin/courses/{{$cat->id}}">{{ucfirst($cat->name)}}</a></li>
                    @endforeach
                </ul>

            </li>
            <li>
                <a href="/admin/addcourse">Add Course <span class="glyphicon glyphicon-plus"></span></a>
            </li>
            <li>
                <a href="/admin/latestregistrations">Latest Registrations</a>
            </li>
            <li>
                <a href="/admin/messages">Messages</a>
            </li>
            <li>
                <a href="#toggle_search" id="toggle_search">Search for registrant
                </a>

                <form id="toggle_form" class="form-inline" style="display:none;" method="POST" action="/admin/searchreg">
                    {{csrf_field()}}
                    <div class="form-group" >
                        <input type="text" class="form-control" placeholder="Enter Registrant ID" name = "Registrant_ID" maxlength="14">

                    </div>
                    <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>

                </form>
            </li>
            
            <li>
                 <a href="/logout">Logout</a>
            </li>
            </ul>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <!--top navbar-->
    <nav class="navbar navbar-default customnav">
        <div class="navbar-brand">
            <a href="#menu-toggle" class="btn btn-success " id="menu-toggle">
                <span class="glyphicon glyphicon-align-justify"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><h4>{{ ucwords(Auth::user()->name)}}</h4>
                </li>
            </ul>

            <form class="navbar-form" action="/admin/searchcourse" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Course Name">
                </div>
                <select class="form-control" name="category_id" >
                    <option value="">Select A Category</option>
                    @foreach($categories as $cats)
                        <option value="{{$cats->id}}">{{$cats->name}}</option>
                    @endforeach

                </select>

                <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>

            </form>

        </div>



    </nav>

    <!--Code must be inside page-conetnt wrapper-->
    <div id="page-content-wrapper">

        <div class="container-fluid">
            @if (count($errors)>0)
                <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li >{{$error}}</li>
                    @endforeach
                </ul>
                    </div>
                @endif
            <!--ADD YOUR CODE HERE -->
           @yield('content')

        </div>
    </div>
</div>

@yield('script')
</body>
</html>