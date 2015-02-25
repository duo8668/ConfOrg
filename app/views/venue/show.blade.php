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
        <strong>Venue Address:</strong> {{ $venue->venue_address }} <br/>        
        <strong>Created By: {{ $created_By->firstname.', '.$created_By->lastname}}</strong> on the {{ date("d F Y",strtotime($venue->created_at)) }} at {{ date("g:i:s A",strtotime($venue->created_at)) }} <br/>        
        @if(!is_null($modified_By))        
        <strong>Updated By: {{ $modified_By->firstname.', '.$modified_By->lastname}}</strong> on the {{ date("d F Y",strtotime($venue->updated_at)) }} at {{ date("g:i:s A",strtotime($venue->updated_at)) }} <br/>
        @endif
    @if($map!='')
        <center>
            <div style="max-width:900px; margin-top:8px; margin-bottom:15px; border-style:solid; border-width:2px;">
                    <?php echo $map['html']; ?> 
            </div>
        </center>
    @endif
    
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
                            <th style="width: 25%;"><input type="text" class="form-control" placeholder="Room" disabled></th>
                            <th style="width: 20%;"><input type="text" class="form-control" placeholder="Room Rental (Per day)" disabled></th>
                            <th style="width: 40%;">Option</th>
                        </tr>
                    </thead>
            
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
    
</div>
@stop