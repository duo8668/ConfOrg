@extends('layouts.dashboard.master')
@section('page-header')
Edit {{ $equipment->EquipmentName }}
@stop
@section('content')
{{ Form::model($equipment, array('route' => array('equipment.update', $equipment->ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('equipmentName')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentName">Equipment Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('equipmentName', $equipment->EquipmentName, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('equipmentName')) <p class="help-block">{{ $errors->first('equipmentName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('equipmentRemarks')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentRemarks">Equipment Remarks</label>
      <div class="col-md-4">                     
        {{ Form::text('equipmentRemarks', $equipment->EquipmentRemarks, array('class' => 'form-control input-md')) }}
         @if ($errors->has('equipmentRemarks')) <p class="help-block">{{ $errors->first('equipmentRemarks') }}</p> @endif
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label" for="category">Category</label>  
      <div class="col-md-4">        
      {{ Form::select('category', $categories, $equipment->Category_ID, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
      {{ Form::submit('Edit this equipment!', array('name'=>'Edit','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>    
{{ Form::close() }}
@stop
