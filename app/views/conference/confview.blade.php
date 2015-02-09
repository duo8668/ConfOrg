@extends('layouts.ajaxSectionPanel')

@section('content')

<script type="text/javascript">
	
	$(document).ready(function(){
	 
		$('#page-header').html('Conference Title : {{ $conf->title }}');
		
		$('.confClass').on('click',function(evt){

		});

		$('#btnParticipate').on('click',function(evt){
			participate($(this).parent().parent());
		});

		$('#btnAddReview').on('click',function(evt){

		});

		$('#btnViewReceipt').on('click',function(evt){

		});


	});

	function participate(source){
 
		$.ajax({
			type: "GET",
			url : "conference/management/participate",
			data : {subject:$(source).attr('id')}
		})
		.done(function(data) {
			
		})
		.fail(function(xhr,stat,msg) {
			alert(xhr.responseText);
		})
		.always(function(data) {

		});

	}

</script>

<div id="">
	<a class ='btn btn-primary btn-sm'href="{{ action('ConferenceController@index') }}" id="btnGoBackConf">Back Conferences</a> 
	<br/>
	<br/>
	<div class="container">
		<div class="row">
			<div id="conf_id_col_{{$conf->conf_id}}" class="col-lg-6 customBorder confClass">
				<div id="buttonContainer" class="col-md-12 ">
					<div class="col-md-12 boldText">Status : {{ $conf->getStatusInConference() }}</div>
					<div class="conferenceDescription">
						<h2>{{ $conf->title }}</h2>
						<p>{{ $conf->description }}</p>
						<p>{{ $conf->begin_date }} to {{ $conf->end_date }}</p>
					</div>
					 
					@if(Auth::user()->hasConfRole($conf->conf_id, Role::Participant()->rolename)){{ Form::button('Participate',array('name'=>'btnParticipate','id'=>'btnParticipate','class'=>'btn btn-default btn-sm')) }} @endif
					@if(Auth::user()->hasConfRole($conf->conf_id, Role::ReviewPanel()->rolename)){{ Form::button('Add Review',array('name'=>'btnAddReview','id'=>'btnAddReview','class'=>'btn btn-default btn-sm')) }} @endif
					@if(Auth::user()->hasConfPermission($conf->conf_id, Permission::FinanceEdit()->permission_name)){{ Form::button('View Receipt',array('name'=>'btnViewReceipt','id'=>'btnViewReceipt','class'=>'btn btn-default btn-sm')) }} @endif
				</div>
			</div>
		</div>
	</div>

	@stop
