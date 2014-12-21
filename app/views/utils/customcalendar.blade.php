
<script>

	$(document).ready(function() {

		var currdate = moment();
		var title ='{{ $title }}';
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaDay'
			},
			defaultDate: moment(),
			lazyFetching : true,
			selectable: true,
			selectHelper: true,			
			selectOverlap : function(event) {
				return !event._allDay;
			},
			eventOverlap: function(stillEvent, movingEvent) {
				return stillEvent.allDay != movingEvent.allDay;
			},
			eventDrop: function(event, delta, revertFunc) {

				if(event.start._d < currdate ||  event.start._d < currdate){
					alert('this is not allowed');
					revertFunc();
				}else{
					if (!confirm("Are you sure about this change?")) {
						revertFunc();
					}else{
						eventData.start = event.start;
						eventData.end = event.end;
					}
				}	
			},
			select: function(start, end , jsEvent, view) {

				if(start > currdate && end > start && end > currdate){
					if (title) {
						eventData = {id : 999999999,title: title,start: start,end: end,backgroundColor :'Orange'};
						title='';
						$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
					}
				}			

				$('#calendar').fullCalendar('unselect');
			}, 
			dayClick: function(date, jsEvent, view) {
			//$('#calendar').fullCalendar( 'changeView', 'agendaDay' );
			//$('#calendar').fullCalendar( 'gotoDate', date );

			if(date._d < currdate){
				return false;
			}
		},
		editable: true,
		eventLimit: true , 
		events: function(start, end, timezone, callback) {
			
			if(eventData != undefined){
				title ='';
				$('#calendar').fullCalendar('renderEvent', eventData, true);
			}

			$.ajax({
				url: '/conference/management/conferenceevents/'+ moment(start).format('YYYY-MM-DD')+'/'+moment(end).format('YYYY-MM-DD'),
				success: function(doc) {/*
					var events = [];
					$(doc).find('event').each(function() {
						events.push({
							title: $(this).attr('title'),
							start: $(this).attr('start') 
						});
		});*/

			callback(doc);
		}
	});
		},
		dayRender:function(date, cell) {

			if (date._d < currdate){
				$(cell).addClass('fc-state-disabled fc-other-month');
			}
		}
	}); 
});

</script>

<div id='calendar'></div>