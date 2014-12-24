<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @if($map!='')
    <div>
	    <?php echo $map['js']; ?>
	</div>
	@endif
   
    <title>Venue - Conference organizer</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">      

</head>

<body>
<center><legend><h1>Create Venue</h1></legend></center>

{{ Form::open(array('route' => 'venue2', 'method'=>'post', 'class' => 'form-horizontal')) }}
    <fieldset>  

    @if($venueName == 'Type the name of the venue here...')
    <!-- Name -->
  	<div class="form-group">
      <label class="col-md-4 control-label" for="venueName">Venue Name</label>  
      <div class="col-md-4">      	
      {{ Form::text('venueName', '' , array('class'=>'form-control input-md', 'placeholder' => $venueName)) }}
      </div>
    </div>
    
    <!-- Address -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
      <div class="col-md-4">                     
        {{ Form::text('venueAddress', '', array('class'=>'form-control input-md', 'placeholder' => $venueAddress )) }}
      </div>
    </div>
    @else
    <!-- Name -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="venueName">Venue Name</label>  
      <div class="col-md-4">        
      {{ Form::text('venueName', $venueName , array('class'=>'form-control input-md')) }}
      </div>
    </div>
    
    <!-- Address -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
      <div class="col-md-4">                     
        {{ Form::text('venueAddress', $venueAddress, array('class'=>'form-control input-md')) }}
      </div>
    </div>
    @endif

    @if($errorMessage=='Invalid Address!' && $venueAddress != 'Type the address of the venue here...')
		<center>
	    	<div class="alert alert-danger" role="alert" style="max-width:690px;" role="alert" span3>{{ $errorMessage }}</div>
		</center>
    @elseif($errorMessage == 'Venue Successfully Created!')
    <center>
        <div class="alert alert-success" role="alert" style="max-width:690px;" role="alert" span3>{{ $errorMessage }}</div>
    </center>
	@endif

    <!--Create Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">            
    		{{Form::submit('Create Venue', ['class' => 'btn btn-primary'])}}
      </div>
    </div>
    </fieldset>

    {{ Form::close() }}

    @if($map!='')
    <center>
	    <div style="max-width:900px">
				<?php echo $map['html']; ?>	
		</div>
	</center>
	@endif
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
