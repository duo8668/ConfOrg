<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Website</title>

		<style>
			.alert{
				background:slategrey;
				color:#fff;
				padding:20px;
				margin-bottom:20px;
			}
		</style>

	</head>
	<body>


		@if(Session::has('message'))
			<div class="alert">
			{{ Session::get('message')	}}
			</div>
		@endif

		@yield('Content')
		 
	</body>
</html>