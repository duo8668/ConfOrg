@extends('layouts.dashboard.master')
@section('page-header')
  Edit {{ $equipmentcategory->equipmentcategory_name }}
@stop
@section('content')
{{ Form::model($equipmentcategory, array('route' => array('equipmentcategory.update', $equipmentcategory->equipmentcategory_id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('categoryName')) has-error @endif">
      <label class="col-md-4 control-label" for="categoryName">category Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('categoryName', $equipmentcategory->equipmentcategory_name, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('categoryName')) <p class="help-block">{{ $errors->first('categoryName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('categoryRemarks')) has-error @endif">
      <label class="col-md-4 control-label" for="categoryRemarks">category Remarks</label>
      <div class="col-md-4">                     
        {{ Form::text('categoryRemarks', $equipmentcategory->equipmentcategory_remark, array('class' => 'form-control input-md')) }}
         @if ($errors->has('categoryRemarks')) <p class="help-block">{{ $errors->first('categoryRemarks') }}</p> @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
      {{ Form::submit('Edit this category!', array('name'=>'Edit','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>    
{{ Form::close() }}

@stop