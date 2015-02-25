@extends('layouts.dashboard.master')
@section('page-header')
All Categories
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Category</li>
</ol>
<hr>

{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Category</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr class="filters">
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Category" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Number of Equipments" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th style="width: 25%;">Option</th>
                    </tr>
                </thead>  
                
            @foreach($equipmentcategory as $key => $value)
                <tr>            
                    <td>{{ link_to_route('equipmentcategory.show', $value->equipmentcategory_name, ['id' => $value->equipmentcategory_id]) }}</td>                               
                    <td>{{ $value->equipments->count() }}</td>
                    <td>{{ $value->status }}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        <a class="btn btn-small btn-primary btn-xs" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id) }}">Show Equipments</a>
                        @if($privilege or $user_id == $value->created_by)                
                        <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id . '/edit') }}">Edit Category</a> 
                        @endif                
                        @if($privilege)
                        @if($value->status=='Pending')                
                        {{ Form::open(array('url' => 'equipmentcategory/modify/' . $value->equipmentcategory_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Approve Category', array('class' => 'btn btn-success btn-xs')) }}
                        {{ Form::close() }}                
                        @endif
                        {{ Form::open(array('url' => 'equipmentcategory/' . $value->equipmentcategory_id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete Category', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @endif                
                        
                    </td>
                </tr>
            @endforeach
            </table> 
        </div> 
    </div>
</div>
<a href="{{ URL::route('equipmentcategory.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add New Category</span></a>
@stop