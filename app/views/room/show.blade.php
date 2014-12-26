@extends('layouts.dashboard.master')
@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop
@section('page-header')
Showing {{ $room->RoomName }}@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $room->RoomName }}</h2>
        <p>
        	<strong>Venue:</strong> {{ $venue->Name }}<br>
            <strong>Room Name:</strong> {{ $room->RoomName }}<br>
            <strong>Room Capacity:</strong> {{ $room->Capacity }}    
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