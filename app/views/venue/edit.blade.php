<!-- app/views/nerds/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>    
    <title>Venue - Conference organizer</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">      

</head>
<body>

<center><legend><h1>Edit {{ $venue->Name }}</h1></legend></center>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($venue, array('route' => array('venue.update', $venue->ID), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
    <div class="form-group @if ($errors->has('venueName')) has-error @endif">
      <label class="col-md-4 control-label" for="venueName">Venue Name</label>  
      <div class="col-md-4">                      
        {{ Form::text('venueName', Input::old('venueName'), array('class' => 'form-control input-md', 'placeholder' => $venue->Name)) }} 
        @if ($errors->has('venueName')) <p class="help-block">{{ $errors->first('venueName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('venueAddress')) has-error @endif">
      <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
      <div class="col-md-4">                     
        {{ Form::text('venueAddress', Input::old('venueAddress'), array('class' => 'form-control input-md', 'placeholder' => $venue->Address)) }}
         @if ($errors->has('venueAddress')) <p class="help-block">{{ $errors->first('venueAddress') }}</p> @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
      {{ Form::submit('Edit the Venue!', array('class' => 'btn btn-primary')) }}
      </div>
    </div>
    </fieldset>    
{{ Form::close() }}
    
</div>
</body>
</html>