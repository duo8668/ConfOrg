@extends('layouts.dashboard.master')

@section('page-header')
Create a conference
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

<script src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script>

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

</style>



@stop

<!-- Content Section -->
@section('content')
<script>

	$(document).ready(function(){

		$('#btnSelectDate').click(function(){
			
			$('#showCalendar').dialog({
				autoOpen: true,
				minHeight: 768,
				width: 1024,
				modal: true,
				closeOnEscape: false,
				draggable: false,
				resizable: false,
				open: function (event, ui) {
					$('.ui-dialog').css('z-index',9999);
					$('.ui-widget-overlay').css('z-index',9998);
					$('#myCalendar').load("../../utils/customcalendar",{'name':'John'}, function( res, stat, xhr ){
						if ( status == "error" ) {
							var msg = "Sorry but there was an error: ";
							$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
						}
					});

				},
				buttons: {
					'Yes': function(){
						$(this).dialog('close');
						callback(true);
					},
					'No': function(){
						$(this).dialog('close');
						callback(false);
					}			
				}
			});


		});
	});

	function callback(evt){

	}

</script>
@if (!Auth::Id())
<div id='divFormBody'>

	{{ Form::open(array('url' => 'conference/management/submitCreateConf')) }}

	{{ Form::label('lblConfTitle', 'Title :') }} {{ Form::text('conferenceTitle',isset($value)?$value:'')}} </br>
	{{ Form::label('lblConfType', 'Type :') }} {{ Form::select('confType',$confTypes) }} </br>
	{{ Form::label('dtConference', 'Date Range :') }} {{ Form::button('Select Date!',array('name'=>'btnSelectDate','id'=>'btnSelectDate')) }} <div id='showCalendar'><div id="myCalendar"></div></div></div></br>
	{{ Form::label('beginDate', 'Begin :') }} {{ Form::text('conferenceTitle',isset($value)?$value:'') }}
	{{ Form::label('endDate', 'End :') }}	{{ Form::text('conferenceTitle',isset($value)?$value:'') }}</br>
	{{ Form::label('isFree', 'IsFree? :') }} {{ Form::checkbox('chkIsFree', 'checked',0) }} </br>

	{{ Form::submit('Click Me!')}}

	{{ Form::close() }}


</div>
@endif

@stop



