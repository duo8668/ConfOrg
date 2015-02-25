@extends('layouts.dashboard.master')
@section('page-header')
    Pending List
@stop
@section('content')
<!-- BREADCRUMB -->

<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Pending</li>
</ol>
<hr>

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:20%"><strong>Requester</strong></td>
            <td style="width:20%"><strong>Request Name</strong></td>
            <td style="width:20%"><strong>Request Status</strong></td>
            <td style="width:40%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>            
            <td>{{ $value->user->firstname }}, {{ $value->user->lastname }}</td>
            @if(!is_null($value->equipment))
            <td><strong>Equipment:</strong> {{ $value->equipment->equipment_name }}</td>             
            @elseif(!is_null($value->equipmentcategory))
            <td><strong>Category:</strong> {{ $value->equipmentcategory->equipmentcategory_name }}</td>             
            @elseif(!is_null($value->venue))
            <td><strong>Venue:</strong> {{ $value->venue->venue_name }}</td>             
            @elseif(!is_null($value->room))
            <td><strong>Room:</strong> {{ $value->room->room_name }}</td>
            @endif

            @if(!is_null($value->equipment))
            <td>{{ $value->equipment->equipment_status }}</td>             
            @elseif(!is_null($value->equipmentcategory))
            <td>{{ $value->equipmentcategory->status }}</td>                         
            @elseif(!is_null($value->venue))
            <td><strong>Delete Venue</strong></td>
            @elseif(!is_null($value->room))
            <td><strong>Delete Room</strong></td>                
            @endif            
            <td>                                
                @if(!is_null($value->equipmentcategory))
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('pending/editCategory/' . $value->equipmentcategory->equipmentcategory_id . '/edit') }}">Edit Category</a>                
                {{ Form::open(array('url' => 'equipmentcategory/modify/' . $value->equipmentcategory->equipmentcategory_id, 'class' => 'inline')) }}
                {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                {{ Form::close() }}
                @elseif(!is_null($value->equipment))
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('pending/editEquipment/' . $value->equipment->equipment_id . '/edit') }}">Edit Equipment</a>                
                {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment->equipment_id, 'class' => 'inline')) }}                                     
                {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                {{ Form::close() }}
                @elseif(!is_null($value->venue))
                {{ Form::open(array('url' => 'pending/removeVenue/' . $value->venue_id, 'class' => 'pull-right')) }}                    
                    {{ Form::submit('Delete this venue', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @elseif(!is_null($value->room))                                 
                {{ Form::open(array('url' => 'pending/removeRoom/' . $value->room_id, 'class' => 'pull-right')) }}
                    {{ Form::submit('Delete this venue', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif                           
            </td>
        </tr>
    @endforeach
    </table> 
</div>
<a href="{{ URL::route('room.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Room</span></a>
@stop