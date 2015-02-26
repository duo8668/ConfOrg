@extends('layouts.dashboard.master')
@section('page-header')
    All Rooms 
@stop
@section('content')
<!-- BREADCRUMB -->

<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Rooms</li>
</ol>
<hr>

{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Rooms</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">   
                <thead>
                    <tr class="filters">
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Venue Name" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Room" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Room Rental (Per day)" disabled></th>
                        <th style="width: 25%;">Option</th>
                    </tr>
                </thead>
               
            @foreach($data as $key => $value)
                <tr>            
                    <td>{{ link_to_route('venue.show', $value->venues->venue_name, ['id' => $value->venue_id]) }}</td>
                    <td>{{ link_to_route('room.show', $value->room_name .' (Capacity:'. $value->capacity .' )', ['id' => $value->room_id]) }}</td>             
                    <td>${{ $value->rental_cost}}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-xs btn-info" href="{{ URL::to('room/' . $value->room_id . '/edit') }}">Edit Room</a>
                        
                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->                

                        @if($value->available=='no')                
                        {{ Form::open(array('url' => 'room/modify/' . $value->room_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Make Room Available', array('class' => 'btn btn-success btn-xs')) }}
                        {{ Form::close() }}
                        @elseif($value->available==='yes')
                        {{ Form::open(array('url' => 'room/modify/' . $value->room_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Make Room Unavailable', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @endif            

                        @if($privilege)
                        {{ Form::open(array('url' => 'room/' . $value->room_id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this room', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @else  
                            @if(is_null($value->pending))                               
                            {{ Form::open(array('url' => 'room/deleterequest/' . $value->room_id, 'class' => 'pull-right')) }}
                                {{ Form::submit('Send Delete Request', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }} 
                            @else
                            {{ Form::open(array('url' => 'room/deleterequest/' . $value->room_id, 'class' => 'pull-right')) }}
                                {{ Form::submit('Cancel Delete Request', array('class' => 'btn btn-success btn-xs')) }}
                            {{ Form::close() }} 
                            @endif                           
                        @endif
                  
                    </td>
                </tr>
            @endforeach
            </table> 
        </div>
    </div>
</div>
<a href="{{ URL::route('room.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Room</span></a>
@stop