@extends('layouts.dashboard.master')
@section('page-header')
All Venues
@stop
@section('content')
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Venue Name</strong></td>
            <td style="width:25%"><strong>Address</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($venue as $key => $value)
        <tr>
            <td>{{ $value->venue_name }}</td> 
            <td>{{ $value->venue_address }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-xs btn-success" href="{{ URL::to('venue/' . $value->venue_id) }}">Show Venue</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-xs btn-info" href="{{ URL::to('venue/' . $value->venue_id . '/edit') }}">Edit Venue</a>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'venue/' . $value->venue_id, 'class' => 'inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Venue', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}

                <button class="btn btn-xs btn-info" onclick="$('#{{$value->venue_id}}').toggle();">Show/Hide</button>
                <div id="{{$value->venue_id}}" style="display:none">  
                    Hide show.....
                </div>

            </td>
        </tr>
    @endforeach  
    </table> 
</div> 
@stop