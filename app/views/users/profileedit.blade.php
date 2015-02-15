@extends('layouts.dashboard.master')

@section('page-header')
Edit Your Profile
@stop

@section('content') 
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('users-profile', ['email' => Auth::user()->email]) }}">Your Profile</a></li>
  <li class="active">Edit Profile</li>
</ol>
<hr>

<!--User setting-->
<div class="row">
  	{{ Form::model($user, array('route' => 'users-change-firstname-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>General</legend>
	        <div class="form-group @if ($errors->has('email')) has-error @endif">
	          {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }} 
	          <div class="col-sm-6">
	            {{ Form::email('email', null, array('class' => 'form-control')) }}
       			 @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
	          </div>
	        </div>
	        <div class="clearfix"></div>
	        
	        <div class="form-group @if ($errors->has('firstname')) has-error @endif">
	          {{ Form::label('firstname', 'First Name', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::text('firstname', null, array('class' => 'form-control')) }}
       			 @if ($errors->has('firstname')) <p class="help-block">{{ $errors->first('firstname') }}</p> @endif
	          </div>
	        </div>

	         <div class="form-group @if ($errors->has('lastname')) has-error @endif">
	          {{ Form::label('lastname', 'Last Name', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::text('lastname', null, array('class' => 'form-control')) }}
       			 @if ($errors->has('lastname')) <p class="help-block">{{ $errors->first('lastname') }}</p> @endif
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Update General Profile', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'])}}
	          </div>
	        </div>
	        
	    </div>
    {{ Form::close() }}

@if($user->password != '')
    {{ Form::model($user, array('route' => 'users-change-password-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>Password</legend>
	        <div class="form-group @if ($errors->has('old_password')) has-error @endif">
	          {{ Form::label('old_password', 'Old Password', ['class' => 'col-sm-2 control-label']) }} 
	          <div class="col-sm-6">
	            {{ Form::password('old_password', array('class' => 'form-control')) }}
       			 @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
	          </div>
	        </div>
	        <div class="clearfix"></div>
	        
	        <div class="form-group @if ($errors->has('password')) has-error @endif">
	          {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('password', array('class' => 'form-control')) }}
       			 @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
	          </div>
	        </div>

	         <div class="form-group @if ($errors->has('confirm_password')) has-error @endif">
	          {{ Form::label('confirm_password', 'New password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('confirm_password', array('class' => 'form-control')) }}
       			 @if ($errors->has('confirm_password')) <p class="help-block">{{ $errors->first('confirm_password') }}</p> @endif
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Update Password', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'])}}
	          </div>
	        </div>
	    </div>
    {{ Form::close() }}
@else
	{{ Form::model($user, array('route' => 'users-input-password-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>Password</legend>
	    	<p class="help-block">You have not set an password for email login!</p>
	        <div class="form-group @if ($errors->has('password')) has-error @endif">
	          {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('password', array('class' => 'form-control')) }}
       			 @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
	          </div>
	        </div>

	         <div class="form-group @if ($errors->has('confirm_password')) has-error @endif">
	          {{ Form::label('confirm_password', 'New password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('confirm_password', array('class' => 'form-control')) }}
       			 @if ($errors->has('confirm_password')) <p class="help-block">{{ $errors->first('confirm_password') }}</p> @endif
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Update Password', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'])}}
	          </div>
	        </div>
	    </div>
    {{ Form::close() }}
@endif

	{{ Form::model($user->profile, array('route' => 'users-change-bio-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>Bio & Location</legend>
	        <div class="form-group @if ($errors->has('bio')) has-error @endif">
	          {{ Form::label('bio', 'Bio', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::textarea('bio', null, array('class' => 'form-control')) }}
       			 @if ($errors->has('bio')) <p class="help-block">{{ $errors->first('bio') }}</p> @endif
	          </div>
	        </div>

	         <div class="form-group @if ($errors->has('location')) has-error @endif">
	          {{ Form::label('location', 'Current Location', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
		       @if($user->profile->location != '')
		       		{{{ $user->profile->location }}}
		       @else
		       		You had not chose a current location
		       @endif
       			@if ($errors->has('location')) <p class="help-block">{{ $errors->first('location') }}</p> @endif
	          </div>
	        </div>

	        <div class="form-group @if ($errors->has('country')) has-error @endif">
	          {{ Form::label('country', 'New Location', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::select('country', $country_options, $user->profile->location, array('class' => 'form-control')) }}
       			 @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Update Bio & Location', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'])}}
	          </div>
	        </div>
	    </div>
    {{ Form::close() }}


@if($user->profile->uid > 0)
	{{ Form::model($user, array('route' => 'users-remove-fb-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>Facebook</legend>
	        <div class="form-group">
	          {{ Form::label('fb_account', 'Facebook Account', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          		{{{ $user->profile->fb_email }}}
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Remove Facebook Account', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
	          </div>
	        </div>
	    </div>
    {{ Form::close() }}
@else
	{{ Form::model($user, array('route' => 'users-add-fb-get', 'method' => 'get', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>Facebook</legend>
	        <div class="form-group">
	          {{ Form::label('fb_account', 'Facebook Account', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          		No Facebook account has been linked yet.
	          </div>
	        </div>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"></label>  
	          <div class="col-sm-6">     
	          	{{ Form::button('Link Facebook Account', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'])}}
	          </div>
	        </div>

	    </div>
    {{ Form::close() }}

@endif

</div>

@stop