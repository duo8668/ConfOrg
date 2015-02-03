@extends('layouts.dashboard.master')

@section('page-header')
Edit Profile
@stop

@section('content') 

<!--First name-->
<form action = "{{URL::route('users-change-firstname-post')}}" method = "post">
{{Form::model($user)}}
	<div>
		{{Form::label('firstname', 'First Name:')}}
		{{Form::text('firstname')}}
		<input type="submit" value="Change first name">
		{{ Form::token() }}
	</div>
{{Form::close()}}
</form>

<!--Last name-->
<form action = "{{URL::route('users-change-lastname-post')}}" method = "post">
{{Form::model($user)}}
	<div>
		{{Form::label('lastname', 'Last Name:')}}
		{{Form::text('lastname')}}
		<input type="submit" value="Change last name">
		{{ Form::token() }}
	</div>
{{Form::close()}}
</form>

<!--Bio-->
<br>
<form action = "{{URL::route('users-change-bio-post')}}" method = "post">
{{Form::model($user->profile)}}
	<div>
		{{Form::label('bio', 'Bio:')}} <br>
		{{Form::textarea('bio')}}<br>
		<input type="submit" value="Change bio">
		{{ Form::token() }}
	</div>
{{Form::close()}}
</div>
</form>

<br>
<!--Location-->
Location:
@if($user->profile->location != '')
	<form action = "{{URL::route('users-change-location-post')}}" method = "post">
		<div>
			Currently living in: {{$user->profile->location}}<br>
			Changing to: {{ Form::select('country', $country_options) }}<br>
			<input type="submit" value="Change location">
 			{{ Form::token() }}
		</div>
	</form>
@else
<form action = "{{URL::route('users-change-location-post')}}" method = "post">
	<div> 
		You had not chose a current location<br>
		Please choose one: {{ Form::select('country', $country_options) }}<br>
		<input type="submit" value="Change location">
	</div>
@endif
</form>


<br>
<!-- Email -->
Email:
 <form action = "{{URL::route('users-request-email-post')}}" method = "post">
 	<div>
 		Old Email: {{ $user->email}}
 	</div>

 	<div>
 		New Email: <input type ="email" name = "new_email">
		 	@if($errors->has('new_email'))
		 		{{ $errors->first('new_email')	}}
		 	@endif
 	</div>
 	<input type="submit" value="Change Email">
 	{{ Form::token() }}
 </form>

<br>
<!-- Password -->
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