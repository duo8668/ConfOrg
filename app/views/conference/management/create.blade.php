@extends('layouts.dashboard.master')

@section('page-header')
Create a conference
@stop
<!-- Bootstrap Core CSS -->

@section('extraScripts')

<link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
 
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
 

 
<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

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




@section('content')

@if (!Auth::Id())
<div id=''>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2014-11-12',
			selectable: true,
			selectHelper: true,
			selectOverlap : function(event) {
			 
			return !event._allDay;
			//return event.rendering === 'background';
		},
		/*
			select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');
			},
			*/
			dayClick: function(date, jsEvent, view) {
			
			$('#calendar').fullCalendar( 'changeView', 'agendaDay' );
			$('#calendar').fullCalendar( 'gotoDate', date )
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2014-11-01'
				},
				{
					title: 'Long Event',
					start: '2014-11-07',
					end: '2014-11-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-09T16:00:00'
				},
				{
					id: 998,
					title: 'Repeating Event',
					start: '2014-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2014-11-11',
					end: '2014-11-13'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T10:30:00',
					end: '2014-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2014-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2014-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-11-13T07:00:00'
				}
			]
		});
		
	});

</script>
	{{ Form::open(array('url' => 'conference/management/submitCreateConf')) }}

	{{ Form::label('lblConfTitle', 'Title :') }} {{ Form::text('conferenceTitle',isset($value)?$value:'')}} </br>
	{{ Form::label('lblConfType', 'Type :') }} {{ Form::select('confType',$confTypes) }} </br>
	{{ Form::label('beginDate', 'Begin :') }} {{ Form::text('conferenceTitle',isset($value)?$value:'') }}</br>
	{{ Form::label('endDate', 'End :') }}	<div id='calendar'></div> </br>
	{{ Form::label('isFree', 'IsFree? :') }} {{ Form::checkbox('chkIsFree', 'checked',0) }} </br>

	{{Form::submit('Click Me!');}}

	{{ Form::close() }}


</div>
@endif

@stop



