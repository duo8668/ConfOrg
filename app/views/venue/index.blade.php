@extends('layouts.dashboard.master')
@section('page-header')
All Venues
@stop
@section('content')
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Address</td>            
        </tr>
    </thead>
    <tbody>
    @foreach($venue as $key => $value)
        <tr>
            <td>{{ $value->venue_name }}</td> 
            <td>{{ $value->venue_address }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'venue/' . $value->venue_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Venue', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('venue/' . $value->venue_id) }}">Show this Venue</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('venue/' . $value->venue_id . '/edit') }}">Edit this Venue</a>

                <button class="btn btn-small btn-info" onclick="$('#{{$value->venue_id}}').toggle();">Show/Hide</button>
                <div id="{{$value->venue_id}}" style="display:none">  
                    Hide show.....
                </div>

            </td>
        </tr>
    </tbody>
    @endforeach    
@stop