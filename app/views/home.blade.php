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
	<li><a href="{{ URL::route('users-invite-friend') }}">Invite a friend!</a></li>
	<li><a href="{{ URL::route('admins-invite-resource') }}">Invite a Resource Provider!</a></li>
	<li>{{link_to('/users/'.Auth::user()->email, 'Your Profile')}}</li>
	<p>Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}.</p>
	<a href="{{ URL::route('users-sign-out') }}">Sign out</a>



<br> 
	<div id="confType" class="dropdown-checkbox dropdown">
					<span class="dropdown-checkbox-nbselected"></span>
				</div>
@if(Session::has('global'))
    {{Session::get('global')}} 
@endif



@stop