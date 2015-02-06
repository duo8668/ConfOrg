@extends('layouts.dashboard.master')

@section('page-header')
Edit Profile
@stop

@section('content') 

<!--User setting-->
<h2>User setting</h2>
<form action = "{{URL::route('users-change-firstname-post')}}" method = "post">
{{Form::model($user)}}
	<div>

		{{Form::label('email', 'Email:')}}
		{{Form::text('email')}} 
			@if($errors->has('email'))
            	{{ $errors->first('email')}}
            @endif
		<br>

		{{Form::label('firstname', 'First Name:')}}
		{{Form::text('firstname')}}  
			@if($errors->has('firstname'))
            	{{ $errors->first('firstname')}}
            @endif
        <br>

		{{Form::label('lastname', 'Last Name:')}}
		{{Form::text('lastname')}}
			@if($errors->has('lastname'))
            	{{ $errors->first('lastname')}}
            @endif
		<br>

		<input type="submit" value="Change user">
		{{ Form::token() }}
	</div>
{{Form::close()}}
</form>


<!--Profile setting-->
<h2>Profile setting</h2>
<!--Bio-->
<form action = "{{URL::route('users-change-bio-post')}}" method = "post">
{{Form::model($user->profile)}}
	<div>
		{{Form::label('bio', 'Bio:')}} 
		{{Form::textarea('bio')}}
			@if($errors->has('bio'))
            	{{ $errors->first('bio')}}
            @endif
        <br>
        <br>
        {{Form::label('location', 'Location:')}} <br>
        {{Form::label('location', 'Current location:')}} 
	       @if($user->profile->location !== '')
	       	{{$user->profile->location}}
	       @else
	       	You had not chose a current location
	       @endif
	    <br> 
	    {{Form::label('location', 'Change to:')}}   
		{{ Form::select('country', $country_options, $user->profile->location) }}
			@if($errors->has('location'))
            	{{ $errors->first('location')}}
            @endif
        <br>
		
		<input type="submit" value="Change profile">
		{{ Form::token() }}
	</div>
{{Form::close()}}
</div>
</form>




<br>
<!-- Password -->
<!--Password setting-->
<h2>Password setting</h2>
@if($user->password != '')
Password:
<br>
<form action = "{{URL::route('users-change-password-post')}}" method = "post">
 	<div>
	 	Old Password: <input type ="password" name = "old_password">
		 	@if($errors->has('old_password'))
		 		{{ $errors->first('old_password')	}}
		 	@endif
 	</div>
 	<div>
	 	New Password: <input type ="password" name = "password">
		 	@if($errors->has('password'))
		 		{{ $errors->first('password')	}}
		 	@endif
 	</div>
 	<div>
	 	Confirm Password: <input type ="password" name = "confirm_password">
		 	@if($errors->has('confirm_password'))
		 		{{ $errors->first('confirm_password')	}}
		 	@endif
 	</div>
 	<input type="submit" value="Change Password">
 	{{ Form::token() }}
 </form>

@else
Password:
<br>
You have not set an password for email login!
<form action = "{{URL::route('users-input-password-post')}}" method = "post">
 	<div>
 	New Password: <input type ="password" name = "password">
	 	@if($errors->has('password'))
	 		{{ $errors->first('password')	}}
	 	@endif
 	</div>
 	<div>
 	Confirm Password: <input type ="password" name = "confirm_password">
	 	@if($errors->has('confirm_password'))
	 		{{ $errors->first('confirm_password')	}}
	 	@endif
 	</div>
 	<input type="submit" value="Change Password">
 	{{ Form::token() }}
 </form>	
@endif
<br>


<br>
<!-- Facebook -->
<div>
Facebook:
@if($user->profile->uid > 0)
<form action = "{{URL::route('users-remove-fb-post')}}" method = "post">
	<!-- Facebook profile picture-->
	<img src="{{ $user->profile->photo}}">
	Facebook account :	{{ $user->profile->fb_email}} <br><br>
 	<input type="submit" value="Unlink Facebook with ORAFER">
 	{{ Form::token() }}
</form>
@else
<form action = "{{URL::route('users-add-fb-get')}}" method = "get">
No Facebook account has been linked yet.<br>
<input type="submit" value="Link Facebook with ORAFER">
 	{{ Form::token() }}
</form>
@endif
</div>

@stop