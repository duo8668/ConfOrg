@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipmentcategory->equipmentcategory_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('equipmentcategory.index') }}">Category</a></li>
  <li class="active">{{{ $equipmentcategory->equipmentcategory_name }}}</li>
</ol>
<hr>

<h2>{{ $equipmentcategory->equipmentcategory_name }}</h2>

@if(!is_null($equipmentList))
<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:40%"><strong>List of Equipments</strong></td>            
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($equipmentList as $key => $value)
        <tr>
            <td>{{ $value->equipment_name .' - '. $value->equipment_remark }}</td>             
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                <a class="btn btn-small btn-success btn-xs" href="{{ URL::to('equipment/' . $value->equipment_id) }}">Show this Equipment</a>
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit this Equipment</a>                
                @if($privilege=true)
                {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this equipment', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}                
                @endif
                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->              
                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->
                
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
@endif
@stop


  