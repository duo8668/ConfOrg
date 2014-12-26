@extends('layouts.dashboard.master')
@section('page-header')
Edit {{ $room->RoomName }}
@stop
@section('content')
{{ Form::model($room, array('route' => array('room.update', $room->ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('venue')) has-error @endif">
      <label class="col-md-4 control-label" for="venue">Venue</label>  
      <div class="col-md-4">        
      {{ Form::select('venue', $venues, $room->Venue_ID, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('venue')) <p class="help-block">{{ $errors->first('venue') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>

    <div class="form-group @if ($errors->has('roomName')) has-error @endif">
      <label class="col-md-4 control-label" for="roomName">Room Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('roomName', $room->RoomName, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('roomName')) <p class="help-block">{{ $errors->first('roomName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('roomCapacity')) has-error @endif">
      <label class="col-md-4 control-label" for="roomCapacity">Room Capacity</label>
      <div class="col-md-4">                     
        {{ Form::text('roomCapacity', $room->Capacity, array('class' => 'form-control input-md')) }}
         @if ($errors->has('roomCapacity')) <p class="help-block">{{ $errors->first('roomRemarks') }}</p> @endif
      </div>
    </div>
    

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
      {{ Form::submit('Edit this room!', array('name'=>'Edit','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>    
{{ Form::close() }}
@stop
