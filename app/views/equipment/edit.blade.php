@extends('layouts.dashboard.master')
@section('page-header')
Edit {{ $equipment->equipment_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('equipment.index') }}">Equipment</a></li>
  <li>{{ link_to_route( 'equipment.show', $equipment->equipment_name, ['id' => $equipment->equipment_id] ) }}</li>
  <li class="active">Edit Equipment</li>
</ol>
<hr>

{{ Form::model($equipment, array('route' => array('equipment.update', $equipment->equipment_id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('equipmentName')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentName">Equipment Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('equipmentName', $equipment->equipment_name, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('equipmentName')) <p class="help-block">{{ $errors->first('equipmentName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('equipmentRemarks')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentRemarks">Equipment Remarks</label>
      <div class="col-md-4">                     
        {{ Form::text('equipmentRemarks', $equipment->equipment_remark, array('class' => 'form-control input-md')) }}
         @if ($errors->has('equipmentRemarks')) <p class="help-block">{{ $errors->first('equipmentRemarks') }}</p> @endif
      </div>
    </div>
    
    <div class="form-group @if ($errors->has('equipmentcategory')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentcategory">Category</label>  
      <div class="col-md-4">        
      {{ Form::select('equipmentcategory', $categories, $equipment->equipmentcategory_id, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('equipmentcategory')) <p class="help-block">{{ $errors->first('equipmentcategory') }}</p> 
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
