@extends('layouts.dashboard.master')
@section('page-header')
  Create Category
@stop
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    
    {{ Form::open(array('url' => 'equipmentcategory', 'class' => 'form-horizontal')) }}
    <fieldset>  
    <div class="form-group @if ($errors->has('categoryName')) has-error @endif">
      <label class="col-md-4 control-label" for="categoryName">Category Name</label>  
      <div class="col-md-4">        
        {{ Form::text('categoryName', Input::old('categoryName'), array('class' => 'form-control input-md')) }} 
        @if ($errors->has('categoryName')) <p class="help-block">{{ $errors->first('categoryName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('categoryRemarks')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-4 control-label" for="categoryRemarks">Category Remarks</label>
      <div class="col-md-4">                     
        {{ Form::text('categoryRemarks', Input::old('categoryRemarks'), array('class' => 'form-control input-md')) }}
         @if ($errors->has('categoryRemarks')) <p class="help-block">{{ $errors->first('categoryRemarks') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">           
      {{ Form::submit('Create category!', array('name'=>'Create','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>
    {{ Form::close() }}
@stop