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
	{{ Form::open(array('url' => 'importData', 'class' => 'form-horizontal', 'files' => true)) }}
	<fieldset>		
		<div class="form-group">
			<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4">      
				{{ Form::submit('Download Excel', array('name'=>'Export','class' => 'btn btn-primary')) }}
			</div>
		</div>

		<div class="form-group @if ($errors->has('venue_name')) has-error @endif">
			<label class="col-md-4 control-label" for="venue_name">Venue Name</label>  
			<div class="col-md-4">        
				{{ Form::text('venue_name', Input::old('venue_name'), array('class' => 'form-control input-md')) }} 
				@if ($errors->has('venue_name')) <p class="help-block">{{ $errors->first('venue_name') }}</p> @endif        
			</div>    
		</div>

		<div class="form-group  @if ($errors->has('venue_address')) has-error @elseif (Session::has('message2')) has-error @endif">
			<label class="col-md-4 control-label" for="venue_address">Venue Address</label>
			<div class="col-md-4">                     
				{{ Form::text('venue_address', Input::old('venue_address'), array('class' => 'form-control input-md')) }}
				@if ($errors->has('venue_address')) <p class="help-block">{{ $errors->first('venue_address') }}</p> 
				@elseif (Session::has('message2')) <p class="help-block">{{ Session::get('message2') }}</p> 
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
		</center>	
			<div class="form-group @if ($errors->has('imported_File')) has-error @endif">
				<label class="col-md-4 control-label" for="imported_File"></label>
				<div class="col-md-4">      										
					{{ Form::file('imported_File', array('id' => 'imported_File', 'style'=> 'margin-top:10px' )) }}								
					@if ($errors->has('imported_File')) <p class="help-block">{{ $errors->first('imported_File') }}</p> @endif					
				</div>
			</div>				

			<div class="form-group">
				<label class="col-md-4 control-label" for="submit"></label>
				<div class="col-md-4">      															
					{{ Form::submit('Import Excel', array('name'=>'Import','class' => 'btn btn-primary')) }}
				</div>
			</div>	
		@endif
	</fieldset>
	{{Form::close()}}	
</div>

<script>
</script>
@stop