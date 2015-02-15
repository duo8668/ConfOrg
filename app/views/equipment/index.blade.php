@extends('layouts.dashboard.master')
@section('page-header')
    All Equipments
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Equipments</li>
</ol>
<hr>

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Equipment</strong></td>
            <td style="width:25%"><strong>Remarks</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->equipment_name .' - '. $value->equipment_remark }}</td> 
            <td>{{ $value->equipmentcategory_name .' - '. $value->equipmentcategory_remark}}</td>                        
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this equipment', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('equipment/' . $value->equipment_id) }}">Show this Equipment</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit this Equipment</a>                
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
<a href="{{ URL::route('equipment.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Equipment</span></a>
@stop