
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="publishable-key" content="{{Config::get('stripe.publishable_key')}}">

    <title>Dashboard - Conference organizer</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.bootstrap.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- <link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css"> -->

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- <script src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script> -->

    <script src="{{ asset('js/jqueryui/jquery.blockUI.js') }}"></script>

    <script src="{{ asset('js/dropper.input.js') }}"></script>

     {{ HTML::script('js/app.js') }}

    @yield('extraScripts')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->