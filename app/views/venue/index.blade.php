@extends('layouts.dashboard.master')
@section('content')

<h1>All the Venues</h1>

<!-- will be used to show any messages -->
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
            <td>{{ $value->Name }}</td> 
            <td>{{ $value->Address }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'venue/' . $value->ID, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Venue', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('venue/' . $value->ID) }}">Show this Venue</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('venue/' . $value->ID . '/edit') }}">Edit this Venue</a>

                <button class="btn btn-small btn-info" onclick="$('#{{$value->ID}}').toggle();">Show/Hide</button>
                <div id="{{$value->ID}}" style="display:none">  
                    Hide show.....
                </div>

            </td>
        </tr>
    @endforeach
@stop