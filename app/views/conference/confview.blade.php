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

				@if(User::IsInRole('participant',$conf->ConfId )){{ Form::button('Participate',array('name'=>'btnParticipate','id'=>'btnParticipate','class'=>'')) }} @endif
				@if(User::IsInRole('review',$conf->ConfId )){{ Form::button('Add Review',array('name'=>'btnAddReview','id'=>'btnAddReview','class'=>'')) }} @endif
				@if(User::IsInRole('fin-view',$conf->ConfId )){{ Form::button('View Receipt',array('name'=>'btnViewReceipt','id'=>'btnViewReceipt','class'=>'')) }} @endif
			</div>
		</div>
	</div>


</div>




@stop
