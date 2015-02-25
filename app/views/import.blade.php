@extends('layouts.dashboard.master')
@section('head-content')
@if(Session::has('map'))    
<div>
	<?php echo Session::get('map')['js']; ?>
</div>    
@endif
@stop
@section('page-header')
Import Venue

@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
	<li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
	<li class="active">Import Venues Information</li>    
</ol>
<hr>
<div Class="container">	
	<h3>Instructions <small><button class="btn btn-xs btn-default" onclick="$('#instructions').toggle();">Show/Hide Instuctions</button></small></h3>
	<div id="instructions">
		<p>1. Download the excel template and replace the sample data with your data.</p>
		<p>2. You may wish to enter name and address of the venue and preview the map to check if the address is correct and appearing correctly on the map.</p>
		<p>3. Upload the excel template with your data and click on import.</p>
	</div>
</div>
<div class="row" style="margin-top:20px">	
	{{ Form::open(array('url' => 'importData', 'class' => 'form-horizontal', 'files' => true)) }}
	<div class="col-md-12">
		<div class="form-group">		
			<div class="col-md-12">      
				{{ Form::submit('Download Excel', array('name'=>'Export','class' => 'btn btn-primary btn-sm')) }}
			</div>
		</div>
		<legend>Check Venue Name and Address</legend>
		<div class="form-group @if ($errors->has('venue_name')) has-error @endif">
			<label class="col-md-2 control-label" for="venue_name">Venue Name</label>  
			<div class="col-md-8">        
				{{ Form::text('venue_name', Input::old('venue_name'), array('class' => 'form-control input-md')) }} 
				@if ($errors->has('venue_name')) <p class="help-block">{{ $errors->first('venue_name') }}</p> @endif        
			</div>    
		</div>

		<div class="form-group  @if ($errors->has('venue_address')) has-error @elseif (Session::has('message2')) has-error @endif">
			<label class="col-md-2 control-label" for="venue_address">Venue Address</label>
			<div class="col-md-8">                     
				{{ Form::text('venue_address', Input::old('venue_address'), array('class' => 'form-control input-md')) }}
				@if ($errors->has('venue_address')) <p class="help-block">{{ $errors->first('venue_address') }}</p> 
				@elseif (Session::has('message2')) <p class="help-block">{{ Session::get('message2') }}</p> 
				@endif
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-2 control-label" for="submit"></label>
			<div class="col-md-8">      
				{{ Form::submit('Preview Map!', array('name'=>'Preview','class' => 'btn btn-primary')) }}
			</div>
		</div>

		<legend>Import Excel</legend>

		<div class="form-group @if ($errors->has('imported_File')) has-error @endif">
			<label class="col-md-2 control-label" for="imported_File">Upload Excel</label>
			<div class="col-md-8">      										
				{{ Form::file('imported_File', array('id' => 'imported_File', 'style'=> 'margin-top:10px' )) }}								
				@if ($errors->has('imported_File')) <p class="help-block">{{ $errors->first('imported_File') }}</p> @endif					
			</div>
		</div>				
		<div class="form-group">
			<label class="col-md-2 control-label" for="submit"></label>
			<div class="col-md-8">      															
				{{ Form::submit('Import Excel', array('name'=>'Import','class' => 'btn btn-primary')) }}
			</div>
		</div>	

		@if(Session::has('map'))      	
		<center>
			<div style="max-width:900px">
				<?php echo Session::get('map')['html']; ?> 
			</div>		
		</center>	
		@endif
	</div>
	{{Form::close()}}	
</div>
@stop