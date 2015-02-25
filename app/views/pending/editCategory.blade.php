@extends('layouts.dashboard.master')
@section('page-header')
  Edit {{ $equipmentcategory->equipmentcategory_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::to('/pending') }}">Pending</a></li>  
  <li class="active">Edit Category</li>
</ol>
<hr>

{{ Form::open(array($equipmentcategory, 'url' => 'pending/'. $equipmentcategory->equipmentcategory_id, 'method' => 'PUT', 'class' => 'form-horizontal')) }}     
    <fieldset>
    <div class="form-group @if ($errors->has('categoryName')) has-error @endif">
      <label class="col-md-4 control-label" for="categoryName">Category Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('categoryName', $equipmentcategory->equipmentcategory_name, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('categoryName')) <p class="help-block">{{ $errors->first('categoryName') }}</p> @endif        
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