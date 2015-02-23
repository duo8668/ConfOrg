@extends('layouts.dashboard.master')

@section('page-header')
All Conferences
@stop

@section('content')

<style>

	body {
		/** margin: 40px 10px; **/
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}
 
	.customBorder:hover{ 
		cursor: pointer;
	}

	.boldText{
		font-weight: bolder;
	}
</style>

<script type="text/javascript">
	
	
	$(document).ready(function(){

		$('.confClass').on('click',function(evt){
			 
			$.ajax({
				type: "GET",
				url : "conference/confParticular",
				data : {subject:$(this).attr('id')}
			})
			.done(function(data) {				 
				$('#displayChannel').html(data);
				$('html,body').animate({scrollTop: $('body').offset().top}, 550);
			})
			.fail(function(xhr,stat,msg) {
				alert(xhr.responseText);
			})
			.always(function(data) {

			});

		});

	});

</script>

<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">All Conferences</li>
</ol>
<hr>
<div class="input-group  col-md-4">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit">Search</button>
	</span>
	<input type="text" class="form-control search-query input-flat">
</div>
<br/>
<br/>
<div class="">
	<div class="row">
		@foreach ($confs as $conf)
		<div id="conf_id_col_{{$conf->conf_id}}" class="col-md-4 confClass customBorder">
			<div class="panel panel-primary  has-ribbon" data-text="<?php //$conf->getStatusInConference(); ?>">
				<div class="panel-heading"><strong><br/></strong></div>
				<div class="panel-body">
					<h5> Title : <small> {{ $conf->title }} </small></h5>
					<h5> Venue : <small> {{ $conf->Room()->Venue()->venue_name }} </small></h5>
					<h5> Room : <small> {{ $conf->Room()->room_name }} </small></h5>
					<h5> Begin : <small> {{ $conf->begin_date }}  </small></h5>
					<h5> End : <small> {{ $conf->end_date }}  </small></h5>
				</div>
			</div>
		</div>
		@endforeach
	</div>


</div>
@stop
