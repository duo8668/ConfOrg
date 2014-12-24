<html>
<head>	
	<?php echo $map['js']; ?>
	<!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

	<center>
		<h1>Welcome to the venue site</h1>

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