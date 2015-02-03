@extends('layouts.dashboard.master')

@section('page-header')
PohJun private home
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<link href="{{ asset('css/multiselect/bootstrap-dropdown-checkbox.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('js/multiselect/bootstrap-dropdown-checkbox.js') }}"></script>

@stop

<!-- Content Section -->
@section('content')

<script>
	$(document).ready(function(){

	$("#confType").dropdownCheckbox({
			data:  {{$fields}},
			title: "Interests",
			showNbSelected:true,
			hideHeader:false,
			autosearch:true,
			templateButton:'<button class="dropdown-checkbox-toggle btn btn-default" data-toggle="dropdown" href="#">Interests<span class="dropdown-checkbox-nbselected"></span> <b class="caret"></b> </button>'
		});
	});
</script>

<!-- Poh Jun Testing -->
<li> <a href="{{ URL::to('/home') }}">Home</a></li>

@if(Auth::check())
	
	
	<li><a href="{{ URL::route('users-invite-friend') }}">Invite a friend!</a></li>
	<li>{{link_to('/users/'.Auth::user()->email, 'Your Profile')}}</li>
	<p>Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}.</p>
	<a href="{{ URL::route('users-sign-out') }}">Sign out</a>


@else
	<li> <a href="{{ URL::route('users-sign-in') }}">Sign In</a></li>
	<li> <a href="{{ URL::route('users-create') }}">Create An Account</a></li>
	<li> <a href="{{ URL::route('users-forget-password') }}">Forget Password?</a></li>
	<p>You are not signed in.</p>
@endif
<br> 
	<div id="confType" class="dropdown-checkbox dropdown">
					<span class="dropdown-checkbox-nbselected"></span>
				</div>
@if(Session::has('global'))
    {{Session::get('global')}} 
@endif



@stop