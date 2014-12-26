@extends('layouts.dashboard.master')
@section('head-content')
  @if(Session::has('map'))    
      <div>
        <?php echo Session::get('map')['js']; ?>
      </div>    
    @endif
@stop
@section('content')
<center><legend><h1>Create Venue</h1></legend></center>

    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    
    {{ Form::open(array('url' => 'venue', 'class' => 'form-horizontal')) }}
    <fieldset>  
    <div class="form-group @if ($errors->has('venueName')) has-error @endif">
      <label class="col-md-4 control-label" for="venueName">Venue Name</label>  
      <div class="col-md-4">        
        {{ Form::text('venueName', Input::old('venueName'), array('class' => 'form-control input-md')) }} 
        @if ($errors->has('venueName')) <p class="help-block">{{ $errors->first('venueName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('venueAddress')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
      <div class="col-md-4">                     
        {{ Form::text('venueAddress', Input::old('venueAddress'), array('class' => 'form-control input-md')) }}
         @if ($errors->has('venueAddress')) <p class="help-block">{{ $errors->first('venueAddress') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">      
      {{ Form::submit('Preview Map', array('name'=>'Preview','class' => 'btn btn-primary')) }}
      {{ Form::submit('Create Venue!', array('name'=>'Create','class' => 'btn btn-primary')) }}
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

              <table>
                    <tr><td><button class="btn btn-small btn-info" onclick="$('#1').toggle();">Show/Hide</button></td></tr>
                    <tr><td><div id="1" style="display: none">
                    Hide show.....
                </div></td></tr>
                <tr><td><button class="btn btn-small btn-info" onclick="$('#2').toggle();">Show/Hide</button></td></tr>
                    <tr><td><div id="2" style="display: none">
                    Hide show.....
                </div></td></tr>
                
                
                </table>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stop