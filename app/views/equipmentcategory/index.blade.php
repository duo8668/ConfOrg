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
            <td style="width:25%"><strong>Remarks</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($equipmentcategory as $key => $value)
        <tr>
            <td>{{ $value->equipmentcategory_name }}</td> 
            <td>{{ $value->equipmentcategory_remark }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'equipmentcategory/' . $value->equipmentcategory_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this equipmentCategory', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id) }}">Show this equipmentCategory</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipmentcategory_id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('equipmentcategory/' . $value->equipmentcategory_id . '/edit') }}">Edit this equipmentCategory</a>
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
<a href="{{ URL::route('equipmentcategory.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Category</span></a>
@stop