@extends('layouts.dashboard.master')
@section('page-header')
Invite a Friend to use ORAFER
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Invite a Friend</li>    
</ol>
<hr>
<div class="row">
  {{ Form::open(array('route' => 'users-invite-friend-post', 'class' => 'form-horizontal','method' => 'POST')) }}
  <div class="col-md-12">

 	<div class="form-group @if ($errors->has('email')) has-error @endif">
      {{ Form::label('email', 'Friend Email', ['class' => 'col-sm-2 control-label']) }}    
      <div class="col-sm-6">     
        {{ Form::email('email', null, array('class' => 'form-control', 'required' => 'required')) }}
      </div>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>
    <div class="clearfix"></div>

    <div class="form-group @if ($errors->has('firstname')) has-error @endif">
      {{ Form::label('firstname', 'Friend First Name', ['class' => 'col-sm-2 control-label']) }}    
      <div class="col-sm-6">     
        {{ Form::text('firstname', null, array('class' => 'form-control', 'required' => 'required')) }}
      </div>
    @if ($errors->has('firstname')) <p class="help-block">{{ $errors->first('firstname') }}</p> @endif
    </div>
    <div class="clearfix"></div>

    <div class="form-group @if ($errors->has('email')) has-error @endif">
      {{ Form::label('email', 'Friend Last Name', ['class' => 'col-sm-2 control-label']) }}    
      <div class="col-sm-6">     
        {{ Form::text('email', null, array('class' => 'form-control', 'required' => 'required')) }}
      </div>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>
    <div class="clearfix"></div>

 	<hr>
    
    <div class="row">  
      <div class="col-md-6 col-md-offset-2">
        <!-- Button -->     
        {{ Form::submit('Send Invite', array('class' => 'btn btn-primary btn-md')) }}
      </div>
    </div> 
 </div>
  {{ Form::close() }} 
</div>

@stop