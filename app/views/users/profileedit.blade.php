@extends('layouts.dashboard.master')

@section('page-header')
Edit Your Profile
@stop

@section('content') 
@if($errors->any())
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-danger">
        <div class="panel-heading"><h3 class="panel-title">Error!</h3></div>
        <div class="panel-body">
          @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endif

<!--User setting-->
<div class="row">
  	{{ Form::model($user, array('route' => 'users-change-firstname-post', 'method' => 'post', 'class' => 'form-horizontal') ) }}
	    <div class="col-md-12">
	    	<legend>General</legend>
	        <div class="form-group">
	          {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }} 
	          <div class="col-sm-6">
	            {{ Form::email('email', null, array('class' => 'form-control')) }}
	          </div>
	        </div>
	        <div class="clearfix"></div>
	        
	        <div class="form-group">
	          {{ Form::label('firstname', 'First Name', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::text('firstname', null, array('class' => 'form-control')) }}
	          </div>
	        </div>

	         <div class="form-group">
	          {{ Form::label('lastname', 'Last Name', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::text('lastname', null, array('class' => 'form-control')) }}
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
	        <div class="form-group">
	          {{ Form::label('old_password', 'Old Password', ['class' => 'col-sm-2 control-label']) }} 
	          <div class="col-sm-6">
	            {{ Form::password('old_password', array('class' => 'form-control')) }}
	          </div>
	        </div>
	        <div class="clearfix"></div>
	        
	        <div class="form-group">
	          {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('password', array('class' => 'form-control')) }}
	          </div>
	        </div>

	         <div class="form-group">
	          {{ Form::label('confirm_password', 'New password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('confirm_password', array('class' => 'form-control')) }}
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
	        <div class="form-group">
	          {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('password', array('class' => 'form-control')) }}
	          </div>
	        </div>

	         <div class="form-group">
	          {{ Form::label('confirm_password', 'New password', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::password('confirm_password', array('class' => 'form-control')) }}
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
	        <div class="form-group">
	          {{ Form::label('bio', 'Bio', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::textarea('bio', null, array('class' => 'form-control')) }}
	          </div>
	        </div>

	         <div class="form-group">
	          {{ Form::label('location', 'Current Location', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
		       @if($user->profile->location != '')
		       		{{{ $user->profile->location }}}
		       @else
		       		You had not chose a current location
		       @endif
	          </div>
	        </div>

	        <div class="form-group">
	          {{ Form::label('country', 'New Location', ['class' => 'col-sm-2 control-label']) }}   
	          <div class="col-sm-6">     
	          {{ Form::select('country', $country_options, $user->profile->location, array('class' => 'form-control')) }}
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