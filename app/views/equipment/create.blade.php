@extends('layouts.dashboard.master')
@section('page-header')
Add New Equipment
@stop
@section('content')
<!-- <center><legend><h1>Create Equipment</h1></legend></center> -->

    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
<div class="row">
  {{ Form::open(array('url' => 'equipment', 'class' => 'form-horizontal')) }}
    <div class="col-md-12">
      <div class="form-group @if ($errors->has('equipmentName')) has-error @endif">
        <label class="col-md-2 control-label" for="equipmentName">Equipment Name</label>  
        <div class="col-md-10">        
          {{ Form::text('equipmentName', Input::old('equipmentName'), array('class' => 'form-control input-md')) }} 
          @if ($errors->has('equipmentName')) <p class="help-block">{{ $errors->first('equipmentName') }}</p> @endif        
        </div>    
      </div>

      <div class="form-group  @if ($errors->has('equipmentRemarks')) has-error @elseif (Session::has('message')) has-error @endif">
        <label class="col-md-2 control-label" for="equipmentRemarks">Equipment Remarks</label>
        <div class="col-md-10">                     
          {{ Form::text('equipmentRemarks', Input::old('equipmentRemarks'), array('class' => 'form-control input-md')) }}
           @if ($errors->has('equipmentRemarks')) <p class="help-block">{{ $errors->first('equipmentRemarks') }}</p> 
           @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
           @endif
        </div>
      </div>

      <div class="form-group @if ($errors->has('equipmentcategory')) has-error @elseif (Session::has('message')) has-error @endif">
        <label class="col-md-2 control-label" for="equipmentcategory">Category</label>  
        <div class="col-md-8">        
        {{ Form::select('equipmentcategory', $categories, null, array('class'=>'form-control input-md')) }}      
        @if ($errors->has('equipmentcategory')) <p class="help-block">{{ $errors->first('equipmentcategory') }}</p> 
        @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
        @endif
        </div>
      </div>
      
      <hr>
      <div class="row">  
        <div class="col-md-8 col-md-offset-2">
          {{ Form::submit('Add Equipment', array('name'=>'Create','class' => 'btn btn-primary btn-md btn-block')) }}
        </div>
      </div>

    </div>
  {{ Form::close() }}
</div>
@stop