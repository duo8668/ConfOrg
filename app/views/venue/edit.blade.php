<!-- app/views/nerds/edit.blade.php -->
@extends('layouts.dashboard.master')
@section('head-content')
  @if(Session::has('map'))    
      <div>
        <?php echo Session::get('map')['js']; ?>
      </div>    
    @endif
@stop
@section('page-header')
Edit {{ $venue->venue_name }}
@stop
@section('content')

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($venue, array('route' => array('venue.update', $venue->venue_id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('venueName')) has-error @endif">
      <label class="col-md-4 control-label" for="venueName">Venue Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('venueName', $venue->venue_name, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('venueName')) <p class="help-block">{{ $errors->first('venueName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('venueAddress')) has-error @endif">
      <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
      <div class="col-md-4">                     
        {{ Form::text('venueAddress', $venue->venue_address, array('class' => 'form-control input-md')) }}
         @if ($errors->has('venueAddress')) <p class="help-block">{{ $errors->first('venueAddress') }}</p> @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
      {{ Form::submit('Preview Map', array('name'=>'Preview','class' => 'btn btn-primary')) }}
      {{ Form::submit('Edit the Venue!', array('name'=>'Edit','class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>    
{{ Form::close() }}

   @if(Session::has('map'))      
    <center>
      <div style="max-width:900px">
        <?php echo Session::get('map')['html']; ?> 
    </div>
  </center>
  @endif
    
</div>
@stop

