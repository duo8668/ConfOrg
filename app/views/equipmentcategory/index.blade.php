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

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Category</strong></td>            
            <td style="width:20%"><strong>Number of Equipments</strong></td>
            <td style="width:25%"><strong>Status</strong></td>
            <td style="width:30%"><strong>Option</strong></td>
        </tr> 
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
<a href="{{ URL::route('equipmentcategory.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add New Category</span></a>
@stop