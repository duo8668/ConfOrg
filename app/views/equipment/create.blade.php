@extends('layouts.dashboard.master')
@section('content')
<center><legend><h1>Create Equipment</h1></legend></center>

    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    
    {{ Form::open(array('url' => 'equipment', 'class' => 'form-horizontal')) }}
    <fieldset>  
    <div class="form-group @if ($errors->has('equipmentName')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentName">Equipment Name</label>  
      <div class="col-md-4">        
        {{ Form::text('equipmentName', Input::old('equipmentName'), array('class' => 'form-control input-md')) }} 
        @if ($errors->has('equipmentName')) <p class="help-block">{{ $errors->first('equipmentName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('equipmentRemarks')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-4 control-label" for="equipmentRemarks">Equipment Remarks</label>
      <div class="col-md-4">                     
        {{ Form::text('equipmentRemarks', Input::old('equipmentRemarks'), array('class' => 'form-control input-md')) }}
         @if ($errors->has('equipmentRemarks')) <p class="help-block">{{ $errors->first('equipmentRemarks') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="category">Category</label>  
      <div class="col-md-4">        
      {{ Form::select('category', $categories, null, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>

    
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">           
      {{ Form::submit('Create equipment!', array('name'=>'Create','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>
    {{ Form::close() }}
@stop