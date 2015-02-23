@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop

@extends('layouts.dashboard.master')
@section('page-header')
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('venue.index') }}">Venues</a></li>
  <li class="active">{{{ $venue->venue_name }}}</li>
</ol>
<hr> 
<div class="container">    
        <h2>{{ $venue->venue_name }}</h2>        
        <p><strong>Venue Address:</strong> {{ $venue->venue_address }}</p>        
        <p><strong>Created By: {{ $created_By->firstname.', '.$created_By->lastname}}</strong> on the {{$venue->created_at}}</p>        
        @if(!is_null($modified_By))        
        <p><strong>Updated By: {{ $modified_By->firstname.', '.$modified_By->lastname}}</strong> on the {{$venue->updated_at}}</p>
        @endif
    @if($map!='')
        <center>
            <div style="max-width:900px; maring-top:5px; margin-bottom:15px; border-style:solid; border-width:2px;">
                    <?php echo $map['html']; ?> 
            </div>
        </center>
    @endif
    
    <table class="table">   
        <tr>            
            <td style="width:25%"><strong>Room</strong></td>
            <td style="width:20%"><strong>Room Rental (Per day)</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>
            <td>{{ link_to_route('room.show', $value->room_name .' (Capacity:'. $value->capacity .' )', ['id' => $value->room_id]) }}</td>    
            <td>${{ $value->rental_cost}}</td>              
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
                    {{ Form::submit('Delete this Room', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif
            </td>
        </tr>
    @endforeach
    </table> 

    
</div>
@stop