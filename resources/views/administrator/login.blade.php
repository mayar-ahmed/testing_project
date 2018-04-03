<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">

    <!-- COMMON CSS FILES -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/font-awesome-4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">

    <!-- PAGE CSS FILE -->

    <link rel="stylesheet" href="/css/admin_login.css"/>




    <!-- COMMON JS FILES -->
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>


    <!-- PAGE JS FILE -->
    <script src="/js/admin_login.js"></script>

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="title"> <h3>Welcome Administrator</h3></div>

    </nav>


   <!--ADD YOUR CODE HERE -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-form">
                <form >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Sign In</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input class="form-control" type ="email" name="email" placeholder="Enter Your Email"/>
                            </div>

                            <div class="form-group">
                                <input class="form-control" type ="password" name="password" placeholder="Enter Your Password" />
                            </div>

                            <input type="submit" name="submit" value="login" class="btn btn-success btn-block btn-lg" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>