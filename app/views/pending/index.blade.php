@extends('layouts.dashboard.master')
@section('page-header')
    Pending Confirmation List
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
            <h3 class="panel-title"><strong>Filter Pending Confirmation</strong></h3>
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
                    <td>
                        @if(!is_null($value->equipment))
                            <strong>Equipment:</strong> {{ $value->equipment->equipment_name }}             
                        @elseif(!is_null($value->equipmentcategory))
                            <strong>Category:</strong>{{ link_to_route('equipmentcategory.show', $value->equipmentcategory->equipmentcategory_name, ['id' => $value->equipmentcategory_id]) }}             
                        @elseif(!is_null($value->venue))
                            <strong>Venue:</strong> {{ link_to_route('venue.show', $value->venue->venue_name, ['id' => $value->venue_id]) }}              
                        @elseif(!is_null($value->room))
                            <strong>Room:</strong>{{ link_to_route('room.show', $value->room->room_name, ['id' => $value->room_id]) }}
                        @endif
                    </td>

                    <td>
                        @if(!is_null($value->equipment))
                            @if($value->delete=='true')
                                <strong>Delete Equipment<strong>             
                            @else
                                {{ $value->equipment->equipment_status }}             
                            @endif
                        @elseif(!is_null($value->equipmentcategory))
                            {{ $value->equipmentcategory->status }}                         
                        @elseif(!is_null($value->venue))
                            <strong>Delete Venue</strong>
                        @elseif(!is_null($value->room))
                            <strong>Delete Room</strong>                
                        @endif 
                    </td>

                    <td>                                
                        @if(!is_null($value->equipmentcategory))
                            <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('pending/editCategory/' . $value->equipmentcategory->equipmentcategory_id . '/edit') }}">Edit Category</a>                
                            {{ Form::open(array('url' => 'equipmentcategory/modify/' . $value->equipmentcategory->equipmentcategory_id, 'class' => 'inline')) }}
                            {{ Form::submit('Approve Category', array('class' => 'btn btn-success btn-xs')) }} 
                            {{ Form::close() }}
                            {{ Form::open(array('url' => 'pending/removeEquipmentCategory/' . $value->equipmentcategory_id, 'class' => 'inline')) }}                    
                                {{ Form::submit('Delete this category', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }}
                        @elseif(!is_null($value->equipment))
                            <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('pending/editEquipment/' . $value->equipment->equipment_id . '/edit') }}">Edit Equipment</a>                
                            {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment->equipment_id, 'class' => 'inline')) }}                                     
                            {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                            {{ Form::close() }}
                            {{ Form::open(array('url' => 'pending/removeEquipment/' . $value->equipment_id, 'class' => 'inline')) }}                    
                                {{ Form::submit('Delete this Equipment', array('class' => 'btn btn-danger btn-xs')) }}
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