<html>
<head>	
	<title>Conference Venue</title>
	<?php echo $map['js']; ?>
	<!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>	
	<center>
		<h1>Welcome, {{ $randomText }} to the venue site - {{ $error }}</h1>
		
		{{ Form::open(array('route' => 'venue', 'method'=>'post')) }}	
			
			{{ Form::text('randomText','',array('id'=>'randomText','class'=>'', 'placeholder' => '')) }}
			{{ Form::submit('Click')	}}

		{{ Form::close() }}
		<div style="max-width:900px">
			<?php echo $map['html']; ?>	
		</div>
	</center> 

	<!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>