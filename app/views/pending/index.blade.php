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

{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Pending Approval</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr class="filters">
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Requester" disabled></th>
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Request Name" disabled></th>
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Request Status" disabled></th>
                        <th style="width: 30%;">Option</th>
                    </tr>
                </thead>   
               
            @foreach($data as $key => $value)
                <tr>            
                    <td>{{ $value->user->firstname }}, {{ $value->user->lastname }}</td>
                    @if(!is_null($value->equipment))
                    
                    <td><strong>Equipment:</strong> {{ $value->equipment->equipment_name }}<</td>             
                    @elseif(!is_null($value->equipmentcategory))
                    <td><strong>Category:</strong>{{ link_to_route('equipmentcategory.show', $value->equipmentcategory->equipmentcategory_name, ['id' => $value->equipmentcategory_id]) }}</td>             
                    @elseif(!is_null($value->venue))
                    <td><strong>Venue:</strong> {{ link_to_route('venue.show', $value->venue->venue_name, ['id' => $value->venue_id]) }} </td>             
                    @elseif(!is_null($value->room))
                    <td><strong>Room:</strong>{{ link_to_route('room.show', $value->room->room_name, ['id' => $value->room_id]) }}</td>
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
                        {{ Form::submit('Approve Category', array('class' => 'btn btn-success btn-xs')) }} 
                        {{ Form::close() }}
                        @elseif(!is_null($value->equipment))
                        <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('pending/editEquipment/' . $value->equipment->equipment_id . '/edit') }}">Edit Equipment</a>                
                        {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment->equipment_id, 'class' => 'inline')) }}                                     
                        {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                        {{ Form::close() }}
                        @elseif(!is_null($value->venue))
                        {{ Form::open(array('url' => 'pending/removeVenue/' . $value->venue_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Delete this venue', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @elseif(!is_null($value->room))                                 
                        {{ Form::open(array('url' => 'pending/removeRoom/' . $value->room_id, 'class' => 'inline')) }}
                            {{ Form::submit('Delete this venue', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @endif                           
                    </td>
                </tr>
            @endforeach
            </table> 
        </div>
    </div>
</div> 
@stop