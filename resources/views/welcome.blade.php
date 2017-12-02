<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    </head>
    <body>

        @if(Auth::user())
            <div class="container">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   <h1>Welcome</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" method="post" onsubmit="return LoginUser()" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="text" name="email" tabindex="1" class="form-control" placeholder="email" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" tabindex="2" class="form-control" placeholder="password">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="register-form" onsubmit="return SignupUser()" method="post" role="form" style="display: none;">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                                    <hr />
                                                    <div class="text-success" id="register-status"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
    </div>
    <script type="text/javascript">

        function LoginUser()
        {
            var token    = $("input[name=_token]").val();
            var email    = $("input[name=email]").val();
            var password = $("input[name=password]").val();

            var data = {
                _token:token,
                email:email,
                password:password
            };

            // Ajax Post 
            $.ajax({
                type: "post",
                url: "/login/user",
                data: data,
                cache: false,
                success: function (data)
                {
                    console.log('login request sent !');
                    console.log('status: ' +data.status);
                    console.log('message: ' +data.message);
                },
                error: function (data){
                    alert('Fail to run Login..');
                }
            });

            return false;
        }

        // login user
        function SignupUser()
        {
            // next code goes here...
            var token       = $("input[name=_token]").val();
            var email       = $("input[name=email]").val();
            var password    = $("input[name=password]").val();

            // garnish the data
            var data = {
                _token:token,
                email:email,
                password:password
            };

            // ajax post 
            $.ajax({
                type: "post",
                url: "/register/user",
                data: data,
                cache: false,
                success: function (data){
                    $("#register-form")[0].reset(); // this reset the form to back to normal
                    $("#register-status").html(data); // this return the data response 4rm backend 
                },
                error: function (data){
                    $("#ajax-error").text('Fail to send request');
                }
            });

            // this make sure the form doesn't load 
            // a form pause
            return false;
        }


        $(function() {
            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                
                e.preventDefault();
                $("#login-form")[0].reset();
            });
            $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                
                e.preventDefault();
                $("#register-form")[0].reset();
            });
        });
    </script>
    </body>
    
</html>
