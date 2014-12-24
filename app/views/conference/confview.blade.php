@extends('layouts.dashboard.master')

@section('page-header')
Conference Title : {{ $selectedConfId }}
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
		border: blue thin solid;
		margin-left: 10px;
		margin-right: 10px;
	}

	.customBorder:hover{
		border: green thin solid;
		cursor: pointer;
	}

	.boldText{
		font-weight: bolder;
	}
</style>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('.confClass').on('click',function(evt){

		});

	});

</script>


@stop

@section('content')

<div class="col-md-12 boldText">Title : {{ $conf->Title }}</div>
<div class="container">
	<div class="row">
		<div id="conf_id_col_{{$conf->ConfId}}" class="col-lg-6 customBorder confClass">
			<div class="col-md-12 ">
				<div class="col-md-12 boldText">Status : {{ $conf->getStatusInConference() }}</div>
				<div class="col-md-12 ">Title : {{ $conf->Title }}</div>
				<div class="col-md-12 ">Description : {{ $conf->Description }}</div>
				<div class="col-md-12 ">ConferenceType : {{ $conf->ConferenceType->ConferenceType }}</div>
				<div class="col-md-12 ">Begin : {{ $conf->BeginDate }}</div>
				<div class="col-md-12 ">End : {{ $conf->EndDate }}</div>

				{{ Form::button('Participate',array('name'=>'btnParticipate','id'=>'btnParticipate','class'=>'')) }}
				{{ Form::button('Add Review',array('name'=>'btnAddReview','id'=>'btnAddReview','class'=>'')) }}
				{{ Form::button('View Receipt',array('name'=>'btnViewReceipt','id'=>'btnViewReceipt','class'=>'')) }}
			</div>
		</div>
	</div>


</div>




@stop
