@extends('layouts.dashboard.master')
@section('page-header')
Add New Room
@stop
@section('content')
<center><legend><h1>Create Room</h1></legend></center>

    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    
    {{ Form::open(array('url' => 'room', 'class' => 'form-horizontal')) }}
    <fieldset>  

    <div class="form-group @if ($errors->has('venue')) has-error @endif">
      <label class="col-md-4 control-label" for="venue">Venue</label>  
      <div class="col-md-4">        
      {{ Form::select('venue', $venues, null, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('venue')) <p class="help-block">{{ $errors->first('venue') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>

    <div class="form-group @if ($errors->has('roomName')) has-error @endif">
      <label class="col-md-4 control-label" for="roomName">Room Name</label>  
      <div class="col-md-4">        
        {{ Form::text('roomName', Input::old('roomName'), array('class' => 'form-control input-md')) }} 
        @if ($errors->has('roomName')) <p class="help-block">{{ $errors->first('roomName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('roomCapacity')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-4 control-label" for="roomCapacity">Room Capacity</label>
      <div class="col-md-4">                     
        {{ Form::text('roomCapacity', Input::old('roomCapacity'), array('class' => 'form-control input-md')) }}
         @if ($errors->has('roomCapacity')) <p class="help-block">{{ $errors->first('roomCapacity') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
      </div>
    </div>

    <div class="form-group @if ($errors->has('equipment')) has-error @endif">
      <label class="col-md-4 control-label" for="venue">Equipments</label>  
      <div class="col-md-4">        
      {{ Form::select('equipment', $equipments, null, array('class'=>'form-control input-md')) }}            
      @if ($errors->has('equipment')) <p class="help-block">{{ $errors->first('equipment') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">           
        {{ Form::submit('Add Equipment!', array('name'=>'Add','class' => 'btn btn-primary')) }}      
      {{ Form::submit('Create Room!', array('name'=>'Create','class' => 'btn btn-primary')) }}      
      </div>
    </div>
    </fieldset>
    {{ Form::close() }}
@stop