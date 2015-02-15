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

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Venue Name</strong></td>
            <td style="width:25%"><strong>Room</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->venue_name}}</td>                        
            <td>{{ link_to_route('room.show', $value->room_name .' (Capacity:'. $value->capacity .' )', ['id' => $value->room_id]) }}</td>             
            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-xs btn-info" href="{{ URL::to('room/' . $value->room_id . '/edit') }}">Edit Room</a>
                
                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'room/' . $value->room_id, 'class' => 'inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this room', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
          
            </td>
        </tr>
    @endforeach
    </table> 
</div>
<a href="{{ URL::route('room.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Room</span></a>
@stop