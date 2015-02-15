@extends('layouts.dashboard.master')
@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop
@section('page-header')
Showing {{ $room->room_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('room.index') }}">Room</a></li>
  <li class="active">{{{ $room->room_name }}}</li>
</ol>
<hr>
    <div class="jumbotron text-center">
        <h2>{{ $room->room_name }}</h2>
        <p>
        	<strong>Venue:</strong> {{ $venue->venue_name }}<br>
            <strong>Room Name:</strong> {{ $room->room_name }}<br>
            <strong>Room Capacity:</strong> {{ $room->capacity }}    
        </p>

    @if($map!='')
        <center>
            <div style="max-width:900px">
                    <?php echo $map['html']; ?> 
            </div>
        </center>
    @endif
    </div>
@stop