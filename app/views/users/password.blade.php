@extends('layouts.dashboard.master')

@section('page-header')
Change Password
@stop

@section('content')
<form action = "{{URL::route('users-change-password-post')}}" method = "post">
 	<div class = "field">
 	Old Password: <input type ="password" name = "old_password">
	 	@if($errors->has('old_password'))
	 		{{ $errors->first('old_password')	}}
	 	@endif
 	</div>
 	<div class = "field">
 	New Password: <input type ="password" name = "password">
	 	@if($errors->has('password'))
	 		{{ $errors->first('password')	}}
	 	@endif
 	</div>
 	<div class = "field">
 	Confirm Password: <input type ="password" name = "confirm_password">
	 	@if($errors->has('confirm_password'))
	 		{{ $errors->first('confirm_password')	}}
	 	@endif
 	</div>
 	<input type="submit" value="Change Password">
 	{{ Form::token() }}
 </form>
 
@if(Session::has('message'))
    {{Session::get('message')}} 
@endif
@stop