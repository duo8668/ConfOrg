@extends('layouts.dashboard.master')
@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop
@section('page-header')
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('room.index') }}">Room</a></li>
  <li class="active">{{{ $room->room_name }}}</li>
</ol>
<hr>
    <div class="container">
        <h2>{{ $room->room_name }}</h2>
        <p>
        	<strong>Venue:</strong> {{ $venue->venue_name }}<br>
            <strong>Room Name:</strong> {{ $room->room_name }}<br>
            <strong>Room Capacity:</strong> {{ $room->capacity }}<br>
            
            <strong>Created By: {{ $created_By->firstname.', '.$created_By->lastname}}</strong> on the {{ date("d F Y",strtotime($room->created_at)) }} at {{ date("g:i:s A",strtotime($room->created_at)) }}        
            @if(!is_null($modified_By))        
            <strong>Updated By: {{ $modified_By->firstname.', '.$modified_By->lastname}}</strong> on the {{ date("d F Y",strtotime($room->updated_at)) }} at {{ date("g:i:s A",strtotime($room->updated_at)) }}
            @endif

    @if($map!='')
        <center>
            <div style="max-width:900px; maring-top:5px; margin-bottom:15px; border-style:solid; border-width:2px;">
                    <?php echo $map['html']; ?> 
            </div>
        </center>
    @endif
    <div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:15%"><strong>Equipment</strong></td>
            <td style="width:15%"><strong>Category</strong></td>
            <td style="width:15%"><strong>Status</strong></td>
            <td style="width:15%"><strong>Quantity</strong></td>
            <td style="width:40%"><strong>Option</strong></td>
        </tr> 
        @foreach($room->equipments as $key => $value)
        <tr>
            <td>{{ $value->equipment_name }}</td> 
            <td>{{ link_to_route('equipmentcategory.show', $value->equipmentCategory->equipmentcategory_name .' - '. $value->equipmentCategory->equipmentcategory_remark, ['id' => $value->equipmentCategory->equipmentcategory_id]) }}</td>
            <td>{{ $value->equipment_status }}</td>
            <td>{{ $value->pivot->quantity }}</td>
            <!-- we will also add show, edit, and delete buttons -->            
            <td>    
                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                @if($privilege==true && $value->equipment_status=='Pending')    
                {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment_id, 'class' => 'inline')) }}                                     
                {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                {{ Form::close() }}                
                @endif
                @if($privilege)
                {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete Equipment', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif   
                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit this Equipment</a>                
            </td>
        </tr>
        @endforeach
    </table> 
</div> 
    </div>
@stop