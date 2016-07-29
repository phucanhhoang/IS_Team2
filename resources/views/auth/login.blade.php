<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-8 col-md-offset-2">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">Login</div>-->
<!--                <div class="panel-body">-->
<!--                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">-->
<!--                        {{ csrf_field() }}-->
<!---->
<!--                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">-->
<!--                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>-->
<!---->
<!--                            <div class="col-md-6">-->
<!--                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">-->
<!---->
<!--                                @if ($errors->has('email'))-->
<!--                                    <span class="help-block">-->
<!--                                        <strong>{{ $errors->first('email') }}</strong>-->
<!--                                    </span>-->
<!--                                @endif-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">-->
<!--                            <label for="password" class="col-md-4 control-label">Password</label>-->
<!---->
<!--                            <div class="col-md-6">-->
<!--                                <input id="password" type="password" class="form-control" name="password">-->
<!---->
<!--                                @if ($errors->has('password'))-->
<!--                                    <span class="help-block">-->
<!--                                        <strong>{{ $errors->first('password') }}</strong>-->
<!--                                    </span>-->
<!--                                @endif-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <div class="col-md-6 col-md-offset-4">-->
<!--                                <div class="checkbox">-->
<!--                                    <label>-->
<!--                                        <input type="checkbox" name="remember"> Remember Me-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <div class="col-md-6 col-md-offset-4">-->
<!--                                <button type="submit" class="btn btn-primary">-->
<!--                                    <i class="fa fa-btn fa-sign-in"></i> Login-->
<!--                                </button>-->
<!---->
<!--                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!DOCTYPE HTML>
<html>
<head>
    <title>Stylitics | Login admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets-admin/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="{{asset('assets-admin/css/style.css')}}" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="{{asset('assets-admin/css/font-awesome.css')}}" rel="stylesheet">
    <style>
        .log-input .has-error input{
            border-color: #ee3b27;
        }
    </style>
</head>

<body class="sign-in-up" style="min-height: auto">
@if (session('message'))
<div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in" style="visibility: hidden">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa {{session('fa-class')}}"></i>
    {{ session('message') }}
</div>
@endif
<section>
    <div id="page-wrapper" class="sign-in-wrapper">
        <div class="graphs">
            <div class="sign-in-form">
                <div class="sign-in-form-top">
                    <p><span>Sign In to</span> <a href="#">Admin</a></p>
                </div>
                <div class="signin">
                    <form method="post" action="{{asset('admin/auth/login')}}">
                        {{ csrf_field() }}
                        <div class="log-input">
                            <div class="log-input-left{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" class="user" name="email" placeholder="E-mail" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="log-input">
                            <div class="log-input-left{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="lock" name="password" placeholder="Password" />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                         <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="submit" value="LOGIN" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
