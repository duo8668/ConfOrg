@extends('layouts.ajaxSectionPanel')

@section('content')

<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#page-header').html('Conference Title : {{ $conf->Title }}');
		
		$('.confClass').on('click',function(evt){

		});

		$('#btnParticipate').on('click',function(evt){
			alert(evt);
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
/*
	function submitAjax(source){
		$(source).attr('id')
		blockUI();
		$.ajax({
			type: "GET",
			url : "conference/confParticular",
			data : {subject:$(this).attr('id')}
		})
		.done(function(data) {
			//alert(data);
			$('#displayChannel').html(data);
		})
		.fail(function(xhr,stat,msg) {
			alert(xhr.responseText);
		})
		.always(function(data) {

		});

	}
	*/
</script>

<div id=""><a href="{{ action('ConferenceController@index') }}" id="btnGoBackConf">Back to Conferences</a></div>
<br/>
<br/>
<div class="container">
	<div class="row">
		<div id="conf_id_col_{{$conf->ConfId}}" class="col-md-6 confClass">
			<div class="panel panel-info">
				<div class="panel-heading"><strong>Status : {{ $conf->getStatusInConference() }}</strong></div>
				<div class="panel-body">
					Title : {{ $conf->Title }}<br />
					Description : {{ $conf->Description }}<br />
					ConferenceType : {{ $conf->ConferenceType->ConferenceType }}<br />
					Begin : {{ $conf->BeginDate }}<br />
					End : {{ $conf->EndDate }}<br />

					@if(User::IsInRole('participant',$conf->ConfId )){{ Form::button('Participate',array('name'=>'btnParticipate','id'=>'btnParticipate','class'=>'btn btn-default')) }} @endif
					@if(User::IsInRole('review',$conf->ConfId )){{ Form::button('Add Review',array('name'=>'btnAddReview','id'=>'btnAddReview','class'=>'btn btn-default')) }} @endif
					@if(User::IsInRole('fin-view',$conf->ConfId )){{ Form::button('View Receipt',array('name'=>'btnViewReceipt','id'=>'btnViewReceipt','class'=>'btn btn-default')) }} @endif
				 </div>
			</div>
		</div>
	</div>
</div>
@stop
