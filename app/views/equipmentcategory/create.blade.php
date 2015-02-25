@extends('layouts.dashboard.master')
@section('page-header')
  Add New Category
@stop
@section('content')
 <!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('equipmentcategory.index') }}">Category</a></li>
  <li class="active">Add Category</li>
</ol>
<hr>

<div class="row"> 
  {{ Form::open(array('url' => 'equipmentcategory', 'class' => 'form-horizontal')) }}
    <div class="col-md-12">
      <div class="form-group @if ($errors->has('categoryName')) has-error @endif">
        <label class="col-md-2 control-label" for="categoryName">Category Name</label>  
        <div class="col-md-10">        
          {{ Form::text('categoryName', Input::old('categoryName'), array('class' => 'form-control input-md')) }} 
          @if ($errors->has('categoryName')) <p class="help-block">{{ $errors->first('categoryName') }}</p> @endif        
        </div>    
      </div>
      
      <hr>
      <div class="row">  
        <div class="col-md-8 col-md-offset-2">       
        {{ Form::submit('Add Category', array('name'=>'Create','class' => 'btn btn-primary btn-md btn-block')) }}
        </div>
      </div>

    </div>
  {{ Form::close() }}
 </div>
@stop