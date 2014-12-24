@extends('layouts.dashboard.master')

@section('page-header')
All Conferences
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/jqueryui/jquery.blockUI.js') }}"></script>

<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 600px;
		margin: 0 auto;
	}

	.customBorder{
		border: green thick solid;
		margin-left: 10px;
		margin-right: 10px;
	}

	.customBorder:hover{
		border: yellow thick solid;
		cursor: pointer;
	}

	.boldText{
		font-weight: bolder;
	}
</style>

<script type="text/javascript">
	$(document).ajaxStop($.unblockUI); 
	
	$(document).ready(function(){

		$('.confClass').on('click',function(evt){
			$(this).attr('id')
			blockUI();
			$.ajax({
				type: "GET",
				url : "conference/confParticular",
				data : {subject:$(this).attr('id')}
			})
			.done(function(data) {
				alert(data);
			})
			.fail(function(xhr,stat,msg) {
				alert(xhr.responseText);
			})
			.always(function(data) {

			});

		});

	});
	
	function blockUI(){

		$.blockUI({ message: "<h1><img src='{{ asset('img/jqueryui/ajax-loader.gif') }}' /> Just a moment...</h1>" }); 
	}
</script>


@stop

@section('content')

<div class="col-md-12 ">Search : </div>
<div class="container">
	<div class="row">

		@foreach ($confs as $conf)

		<div id="conf_id_col_{{$conf->ConfId}}" class="col-lg-3 customBorder confClass">
			<div class="col-md-12 ">
				<div class="col-md-12 boldText">Status : {{ $conf->getStatusInConference() }}</div>
				<div class="col-md-12 ">Title : {{ $conf->Title }}</div>
				<div class="col-md-12 ">ConferenceType : {{ $conf->ConferenceType->ConferenceType }}</div>
				<div class="col-md-12 ">Begin : {{ $conf->BeginDate }}</div>
				<div class="col-md-12 ">End : {{ $conf->EndDate }}</div>
			</div>
		</div>

		@endforeach
	</div>


</div>




@stop
