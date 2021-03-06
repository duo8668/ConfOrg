<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ORAFER - Welcome!</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Checbox -->
    <link href="{{ asset('css/icheck/square/green.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/bootstrap.js') }}"></script>

        <script src="{{ asset('js/landing-page.js') }}"></script>

        <!-- Bootstrap Checbox -->
        <script src="{{ asset('js/icheck/icheck.js') }}"></script>

    </head>

    <body>
        <div id="top"></div>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a href="{{ URL::to('/') }}">{{ HTML::image('img/logo.png', 'ORAFER', ['class' => 'logo']) }}</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">                    
                        <li><a href="{{ URL::to('/#features') }}" class="features">Features</a></li>  
                        <li><a href="{{ URL::to('/contact') }}" class="contact_us">Contact</a></li> 
                        <li><a href="{{ URL::route('conference.public_list') }}">Conferences</a></li> 
                        @if (Auth::check() == true) 
                        <li><a href="{{ URL::route('users-sign-in') }}">Hello, {{{ Auth::user()->firstname }}} {{{ Auth::user()->lastname }}}</a></li> 
                        @else             
                        <li><a href="{{ URL::route('users-sign-in') }}">Sign in</a></li>
                        <li><a href="{{ URL::route('users-create') }}">Sign Up</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>