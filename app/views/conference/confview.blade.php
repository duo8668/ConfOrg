@extends('layouts.ajaxSectionPanel')

@section('content')

<script type="text/javascript">
	
	$(document).ready(function(){
		$(document).ajaxStop($.unblockUI); 

		$('#page-header').html('Conference Title : {{ $conf->Title }}');
		
		$('.confClass').on('click',function(evt){

		});

		$('#btnParticipate').on('click',function(evt){
			participate($(this).parent().parent());
		});

		$('#btnAddReview').on('click',function(evt){

		});

		$('#btnViewReceipt').on('click',function(evt){

		});

		$( "#btnGoBackConf" )
		.button()
		.click(function( event ) {

		});


	});

	function participate(source){

		blockUI();
		$.ajax({
			type: "GET",
			url : "conference/management/participate",
			data : {subject:$(source).attr('id')}
		})
		.done(function(data) {
			alert(data);
			//$('#displayChannel').html(data);
		})
		.fail(function(xhr,stat,msg) {
			alert(xhr.responseText);
		})
		.always(function(data) {

		});

	}

</script>

<div id="">
	<a href="{{ action('ConferenceController@index') }}" id="btnGoBackConf">Back Conferences</a> 
	<br/>
	<br/>
	<div class="container">
		<div class="row">
			<div id="conf_id_col_{{$conf->ConfId}}" class="col-lg-6 customBorder confClass">
				<div id="buttonContainer" class="col-md-12 ">
					<div class="col-md-12 boldText">Status : {{ $conf->getStatusInConference() }}</div>
					<div class="conferenceDescription">
						<h2>{{ $conf->Title }}</h2>
						<p>{{ $conf->ConferenceType->ConferenceType }}</p>
						<p>{{ $conf->Description }}</p>
						<p>{{ $conf->BeginDate }} to {{ $conf->EndDate }}</p>
					</div>
					 
					@if(User::IsInRole('participant',$conf->ConfId )){{ Form::button('Participate',array('name'=>'btnParticipate','id'=>'btnParticipate','class'=>'')) }} @endif
					@if(User::IsInRole('review',$conf->ConfId )){{ Form::button('Add Review',array('name'=>'btnAddReview','id'=>'btnAddReview','class'=>'')) }} @endif
					@if(User::IsInRole('fin-view',$conf->ConfId )){{ Form::button('View Receipt',array('name'=>'btnViewReceipt','id'=>'btnViewReceipt','class'=>'')) }} @endif
				</div>
			</div>
		</div>
	</div>

	@stop
