@extends('layouts.dashboard.master')
@section('head-content')
@if(Session::has('map'))    
<div>
	<?php echo Session::get('map')['js']; ?>
</div>    
@endif
@stop
@section('page-header')
Import/Export
@stop
@section('content')
<div class="container">
	{{ Form::open(array('url' => 'download', 'class' => 'form-horizontal', 'files' => true)) }}
	<fieldset>		
		<div class="form-group">
			<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4">      
				{{ Form::submit('Download Excel', array('name'=>'Export','class' => 'btn btn-primary')) }}
			</div>
		</div>

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
				{{ Form::submit('Preview Map!', array('name'=>'Preview','class' => 'btn btn-primary')) }}
			</div>
		</div>

		@if(Session::has('map'))      
		<center>
			<div style="max-width:900px">
				<?php echo Session::get('map')['html']; ?> 
			</div>			
<div class="form-group">
	<label class="col-md-4 control-label" for="submit"></label>
	<div class="col-md-2">      										
		{{ Form::file('excel', array('id' => 'excel', 'style'=> 'margin-top:40px' )) }}						
		{{ Form::submit('Import Excel', array('name'=>'Import','class' => 'btn btn-primary', 'style'=> 'margin-top:20px;')) }}
	</div>
</div>	
		</center>
		@endif
	</fieldset>
	{{Form::close()}}	
</div>

<script>
</script>
@stop