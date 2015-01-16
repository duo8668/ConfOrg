@extends('layouts.dashboard.master')
@section('page-header')
All Rooms
@stop
@section('content')

<!-- will be used to show any messages
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif-->

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Venue</td>
            <td>Room</td>                                    
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->venue_name}}</td>                        
            <td>{{ $value->room_name .' (Capacity:'. $value->capacity .' )' }}</td>             
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'room/' . $value->room_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this room', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('room/' . $value->room_id) }}">Show this Room</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('room/' . $value->room_id . '/edit') }}">Edit this Room</a>                
            </td>
        </tr>
    @endforeach
@stop