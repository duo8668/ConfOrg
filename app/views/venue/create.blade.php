@extends('layouts.dashboard.master')
@section('head-content')
  @if(Session::has('map'))    
      <div>
        <?php echo Session::get('map')['js']; ?>
      </div>    
    @endif
@stop
@section('page-header')
Add New Venue
@stop
@section('content')
   
    <div class="row">
    {{ Form::open(array('route' => 'venue.store', 'class' => 'form-horizontal')) }}
    
    <div class="form-group @if ($errors->has('venue_name')) has-error @endif">
      <label class="col-md-2 control-label" for="venue_name">Venue Name</label>  
      <div class="col-md-8">        
        {{ Form::text('venue_name', null, array('class' => 'form-control input-md')) }} 
        @if ($errors->has('venue_name')) <p class="help-block">{{ $errors->first('venue_name') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('venue_address')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-2 control-label" for="venue_address">Venue Address</label>
      <div class="col-md-6">                     
        {{ Form::text('venue_address', null, array('class' => 'form-control input-md')) }}
         @if ($errors->has('venue_address')) <p class="help-block">{{ $errors->first('venue_address') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
         
      </div>
      <div class="col-md-2">  
        {{ Form::submit('Preview Map', array('name'=>'Preview','class' => 'btn btn-info btn-sm btn-block')) }}
      </div>   
    </div>
    <hr>
    <div class="row">  
      <div class="col-md-8 col-md-offset-2">
        <!-- Button -->        
        {{ Form::submit('Add Venue', array('class' => 'btn btn-primary btn-md btn-block')) }}

      </div>
    </div>     
    {{ Form::close() }}
    </div>

    @if(Session::has('map'))      
      <center>
        <div style="max-width:900px">
          <?php echo Session::get('map')['html']; ?> 
      </div>
    </center>
    @endif    
@stop