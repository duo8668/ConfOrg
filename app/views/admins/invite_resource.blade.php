@extends('layouts.dashboard.master')
@section('page-header')
Invite a Resource Provider
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Invite a Resource Provider</li>    
</ol>
<hr>
<div class="row">
	<div class="col-md-12">
  	{{ Form::open(array('route' => 'admins-invite-resource-post', 'class' => 'form-horizontal','method' => 'POST')) }}
 	
	 	<legend>Invite Resource Provider Company</legend>
	 	<div class="form-group @if ($errors->has('email')) has-error @endif">
	      {{ Form::label('email', 'Resource Provider Email', ['class' => 'col-md-2 control-label']) }}    
	      <div class="col-sm-6">     
	        {{ Form::email('email', null, array('class' => 'form-control', 'required' => 'required')) }}
	      </div>
	    	@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
	    </div>
	    <div class="clearfix"></div>

	    <div class="form-group @if ($errors->has('company')) has-error @endif">
	      {{ Form::label('company', 'Resource Provider Email', ['class' => 'col-md-2 control-label']) }}    
	      <div class="col-sm-6">   
	       {{ Form::select('company', $company_options, null, ['class' => 'form-control', 'required' => 'required']) }}
	       <p class="help-block">If the company name is not listed here, please add it in first in the form below</p>
	      </div>
	    	@if ($errors->has('company')) <p class="help-block">{{ $errors->first('company') }}</p> @endif
	    </div>
	    <div class="clearfix"></div>
	    <div style="margin-bottom:20px;"
	 	<div class="row">  
	      <div class="col-md-6 col-md-offset-2">
	        <!-- Button -->     
	        {{ Form::submit('Send Invite', array('class' => 'btn btn-primary btn-md')) }}
	      </div>
	    </div>
 	{{ Form::close() }} 
 	 <div style="margin-bottom:40px;">
 	{{ Form::open(array('route' => 'admins-add-company-post', 'class' => 'form-horizontal','method' => 'POST')) }}
		<legend>Add New Company</legend>

 		<div class="form-group @if ($errors->has('new')) has-error @endif">
	      {{ Form::label('new', 'Company Name', ['class' => 'col-md-2 control-label']) }}    
	      <div class="col-sm-6">     
	        {{ Form::text('new', null, array('class' => 'form-control', 'required' => 'required')) }}
	      </div>
	    	@if ($errors->has('new')) <p class="help-block">{{ $errors->first('new') }}</p> @endif
	    </div>
	    <div class="clearfix"></div>
 		 <div style="margin-bottom:20px;"
 		<div class="row">  
	      <div class="col-md-6 col-md-offset-2">
	        <!-- Button -->     
	        {{ Form::submit('Add Company', array('class' => 'btn btn-primary btn-md')) }}
	      </div>
	    </div>
 	{{ Form::close() }} 
 	
 	</div>
</div>


@stop
