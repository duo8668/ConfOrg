@extends('layouts.dashboard.master')
@section('page-header')
All Rooms
@stop
@section('content')
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
            <td>{{ $value->room_name .' (Capacity:'. $value->capacity .' )' }}</td>             
            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-xs btn-success" href="{{ URL::to('room/' . $value->room_id) }}">Show Room</a>

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
@stop