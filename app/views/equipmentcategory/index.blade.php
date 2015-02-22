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
            <td style="width:25%"><strong>Number of Equipments</strong></td>
            <td style="width:30%"><strong>Option</strong></td>
        </tr> 
    @foreach($equipmentcategory as $key => $value)
        <tr>
            <td>{{ $value->equipmentcategory_name }}</td>                                 
            <td>{{ $value->equipments->count() }}</td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                <a class="btn btn-small btn-success btn-xs" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id) }}">Show equipments</a>
                @if($privilege)                
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id . '/edit') }}">Edit Category Name</a>
                {{ Form::open(array('url' => 'equipmentcategory/' . $value->equipmentcategory_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Category', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif                

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                

                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipmentcategory_id}/edit -->
                
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
<a href="{{ URL::route('equipmentcategory.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add New Category</span></a>
@stop