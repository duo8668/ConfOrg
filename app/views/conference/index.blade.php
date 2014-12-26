@extends('layouts.dashboard.master')

@section('page-header')
All Conferences
@stop

@section('content')

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

	<style>
		/* Additional CSS for ribbons only */
		/* ribbon style */

		.ribbon-wrapper {
			position: relative;
			border-bottom: 0px solid #ccc;
			border-top: 10px solid #ccc;
			-moz-border-bottom-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
			-webkit-border-bottom-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
			-moz-border-top-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
			-webkit-border-top-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
		}
		.ribbon-front {
			background-color: #0D7CEB;	height: 40px;
			width: 110px;
			position: relative;
			left:-10px;
			z-index: 2;
		}

		.ribbon-front,
		.ribbon-back-left,
		.ribbon-back-right
		{
			-moz-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
			-khtml-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
			-webkit-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
			-o-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
		}

		.ribbon-edge-topleft,
		.ribbon-edge-topright,
		.ribbon-edge-bottomleft,
		.ribbon-edge-bottomright {
			position: absolute;
			z-index: 1;
			border-style:solid;
			height:0px;
			width:0px;
		}

		.ribbon-edge-topleft,
		.ribbon-edge-topright {
		}

		.ribbon-edge-bottomleft,
		.ribbon-edge-bottomright {
			top: 40px;
		}

		.ribbon-edge-topleft,
		.ribbon-edge-bottomleft {
			left: -10px;
			border-color: transparent #11478D transparent transparent;
		}

		.ribbon-edge-topleft {
			top: -10px;
			border-width: 10px 10px 0 0;
		}
		.ribbon-edge-bottomleft {
			border-width: 0 10px 0px 0;
		}

		.ribbon-edge-topright,
		.ribbon-edge-bottomright {
			left: 100px;
			border-color: transparent transparent transparent #11478D;
		}

		.ribbon-edge-topright {
			top: 0px;
			border-width: 0px 0 0 0px;
		}
		.ribbon-edge-bottomright {
			border-width: 0 0 0px 0px;
		}

		.ribbon-back-left {
			position: absolute;
			top: -10px;
			left: -30px;
			width: 30px;
			height: 40px;
			background-color: #1F66D1;	z-index: 0;
		}

		.ribbon-back-right {
			position: absolute;
			top: 0px;
			right: 0px;
			width: 0px;
			height: 40px;
			z-index: 0;
		}

	</style>
</style>

<script type="text/javascript">
	
	
	$(document).ready(function(){

		$(document).ajaxStop($.unblockUI); 
		
		$('.confClass').on('click',function(evt){
			$(this).attr('id')
			blockUI();
			$.ajax({
				type: "GET",
				url : "conference/confParticular",
				data : {subject:$(this).attr('id')}
			})
			.done(function(data) {				 
				$('#displayChannel').html(data);
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


<div class="input-group  col-md-4">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit">Search</button>
	</span>
	<input type="text" class="form-control search-query input-flat">
</div>
<br/>
<br/>
<div class="container">
	<div class="row">

		@foreach ($confs as $conf)
		
		<div id="conf_id_col_{{$conf->ConfId}}" class="col-lg-3 customBorder confClass">
			<!-- RIBBON -->
			<div class="ribbon-wrapper">
			<div class="ribbon-front">{{ $conf->getStatusInConference() }}
				</div>
				<div class="ribbon-edge-topleft"></div>
				<div class="ribbon-edge-topright"></div>
				<div class="ribbon-edge-bottomleft"></div>
				<div class="ribbon-edge-bottomright"></div>
				<div class="ribbon-back-left"></div>
				<div class="ribbon-back-right"></div>
			</div>

			<div class="col-md-12 ">
				<!-- <div class="col-md-12 boldText">Status : {{ $conf->getStatusInConference() }}</div> -->
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
