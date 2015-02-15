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
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="top"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a href="#">{{ HTML::image('img/logo.png', 'ORAFER', ['class' => 'logo']) }}</a>
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
                    <li><a href="#nav-section1" class="nav-section1">Features</a></li>                
                    <li><a href="{{ URL::route('users-sign-in') }}">Sign in</a></li>
                    <li><a href="{{ URL::route('users-create') }}">Sign Up</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Welcome to ORAFER</h1>
                        <h3>A solution for easy organization of Conference</h3>
                        <hr class="intro-divider">                   
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
    <div id="nav-section1"></div>

    <!-- Features Start -->
	<!-- <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Collaborative Organizer</h2>
                    <p class="lead">Work together with your program committee! Conference Organizer provides easy management of conference organization, including paper submission, review process, and venue bookings.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/collaborative-2.jpg" alt="">
                </div>
            </div>
        </div> -->
        <!-- /.container -->
    <!-- </div> -->
    <!-- /.content-section-a -->

    <!-- <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Access to your content 24/7</h2>
                    <p class="lead">Access all of your conferences' submissions, reviews, venues, participants and all other details online, anytime.</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/onthecloud.jpg" alt="">
                </div>
            </div>
        </div> -->
        <!-- /.container -->
    <!-- </div> -->
    <!-- /.content-section-b -->

    <!-- <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Mobile-friendly design</h2>
                    <p class="lead">Get mobile! Easily access your content from any device, anywhere.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/mobile-friendly.jpg" alt="">
                </div>
            </div>
        </div> -->
        <!-- /.container -->
    <!-- </div> -->
    <!-- /.content-section-a -->
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-html5"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Title</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-group"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Easy Access</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-css3"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Title</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Get started right now!</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="{{ URL::route('users-sign-in') }}" class="btn btn-default btn-lg"><span class="network-name"><i class="fa fa-user fa-fw"></i> Sign in</span></a>
                        </li>
                        <li>
                            <a href="{{ URL::route('users-create') }}" class="btn btn-info btn-lg"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Sign up</span></a>
                        </li>                
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#top">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about-section">About</a>
                        </li>   
                    </ul>
                    <p class="copyright text-muted small">&copy; IT14/4A 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/landing-page.js') }}"></script>

</body>
</html>
