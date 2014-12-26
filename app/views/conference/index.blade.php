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

	#calendar {
		max-width: 600px;
		margin: 0 auto;
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
<div class="">
	<div class="row">
		@foreach ($confs as $conf)
		<div id="conf_id_col_{{$conf->ConfId}}" class="col-md-4 confClass customBorder">
			<div class="panel panel-primary  has-ribbon" data-text="{{ $conf->getStatusInConference() }}">
				<div class="panel-heading"><strong><br/></strong></div>
				<div class="panel-body">
					Title : {{ $conf->Title }}<br />
					ConferenceType : {{ $conf->ConferenceType->ConferenceType }}<br />
					Begin : {{ $conf->BeginDate }}<br />
					End : {{ $conf->EndDate }}<br />
				</div>
			</div>
		</div>
		@endforeach
	</div>


</div>
@stop
