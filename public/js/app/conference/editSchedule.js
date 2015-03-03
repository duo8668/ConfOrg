/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 var currdate,eventData;
 var _viewContainer, notifyTimer = null;

 function loadEditSchedule(urlGetAvailableConferenceScheduleEvents, confroomschedule_id, urlAddConferenceScheduleEvents, urlGetConferenceScheduleEvents){

 	$("#ddlscheduleConferenceDate").selectBoxIt({
 		// Uses the jQuery 'fadeIn' effect when opening the drop down
 		showEffect: "fadeIn",
 		// Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
 		showEffectSpeed: 200,
 		// Uses the jQuery 'fadeOut' effect when closing the drop down
 		hideEffect: "fadeOut",
 		// Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
 		hideEffectSpeed: 200

 	}).off('change.selectBoxIt').on('change.selectBoxIt',function(evt,obj){
 		currdate = moment($('#ddlscheduleConferenceDate').val());
 		$('#calendar').fullCalendar('gotoDate',$('#ddlscheduleConferenceDate').val()); 
 	});
 	
 	$('.selectboxit-list > li').off('mouseenter').on('mouseenter',function(evt,obj){
 		console.log('=====   mouseenter   =====');
 		
 		console.log($(evt.currentTarget).find('a').text());
 	}).off('mouseleave').on('mouseleave',function(evt,obj){
 		console.log('=====   mouseleave   =====');
 		
 		console.log($(evt.currentTarget).find('a').text());
 	});
 	
 	$('#btnEditSchedule').off('click').on('click', function (e) {
 		$.ajax({
 			url: urlGetAvailableConferenceScheduleEvents,
 			data:{ scheduleId: confroomschedule_id },
 			success: function(data) {
 				$('#external-events').html($('#external-events').children().first()); 
 				$.each(data,function(index,value){
 					var _newEvent = $('<div class="fc-event">' + value.title +'</div>');
 					makeDataEvent(_newEvent,value);
 					makeDraggable(_newEvent);
 					$('#external-events').append(_newEvent);
 				});
 			}
 		});

 		//$('#external-events').html($('#external-events').children().first()); 
 		$('#scheduleEditor').modal({
 			keyboard: false
 			, backdrop: 'static'
 			, show : true
 		});
 	});

 	//* Bind 'beforeShown' Event for the modal of #scheduleEditor
 	$('#scheduleEditor').on('beforeShown.bs.modal',function(e){
 		currdate = moment($('#ddlscheduleConferenceDate').val());
 		loadCalendar(urlGetConferenceScheduleEvents, confroomschedule_id);
 		$('#external-events').css('min-width',$('#external-events').width());
 		$('#eventTrash').css('min-width',$('#external-events').width());
 		$('#calendar').fullCalendar('gotoDate',$('#ddlscheduleConferenceDate').val()); 
 	});

 	//* Bind 'hide' Event for the modal of #scheduleEditor
 	$('#scheduleEditor').on('hide.bs.modal',function(e){
 		$('#calendar').fullCalendar('destroy');
 		$('#external-events').html($('#external-events').children().first());
 	});

 	//* Bind Event on Save Schedule
 	$('#btnSaveSchedule').off('click').on('click', function (e) {

 		var dataArray =$('#calendar').fullCalendar('clientEvents'), arrayToSubmit = [];

 		$.each(dataArray,function(index,value){
 			console.log(value);


 			var innerData = { eventId:value.eventId ,sub_id: value.sub_id, title:value.title, start:value.start.format('YYYY-MM-DD HH:mm:ss'), end: value.end.format('YYYY-MM-DD HH:mm:ss'), className: value.className };
 			arrayToSubmit.push(innerData);
 		});

 		$.ajax({url: urlAddConferenceScheduleEvents
 			, data: { scheduleId: confroomschedule_id, allEvents: arrayToSubmit }
 			, type: 'get'
 			, dataType: 'json'
 			, beforeSend: function () {
 				$('#modalMessage').html('Loading...');
 				$('#resultModal').modal({
 					keyboard: false
 					, backdrop: 'static'});
 			}}).done(function (data) {
 				//change the current
 				console.log(data);
 				if (data.success !== undefined) {
 					var message = data.success.numRowAffected + ' record(s) updated successfully !!!';
 					$('#modalMessage').html(message);
 				}
 				setTimeout(function () {
 					$('#publicCalendar').fullCalendar('refetchEvents');
 					$('#resultModal').modal('hide');
 					$('#scheduleEditor').modal('hide');
 				}, 1000);
 			}).fail(function (data) {

 				if (data.responseJSON !== undefined) {
 					if (data.responseJSON.error !== undefined) {
 						var message = data.responseJSON.error.type + ' : ' + data.responseJSON.error.message;
 						$('#modalMessage').html(message);
 						setTimeout(function () {
 							$('#resultModal').modal('hide');
 						}, 1500);
 					}
 				}
 			}).always(function(){
 				setTimeout(function () {
 					$('#publicCalendar').fullCalendar( 'refetchEvents' );
 					$('#resultModal').modal('hide');
 				}, 1000);
 			});
 		});
}

function makeDraggable(el) {
	$(el).draggable({
		zIndex: 888,
		revert: true,
		revertDuration: 0
	});
}


function makeDataEvent(el, event) {
	if (event === undefined || event === null) {
		$(el).data('event', {
			title: $.trim($(el).text()), // use the element's text as the event title
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});
	} else {

		if(event.start !== undefined && event.end !== undefined)
			var myDuration = moment.utc(event.end.diff(event.start, 'milliseconds')).format('HH:mm:ss');

		$(el).data('event', {
			sub_id: event.sub_id,
			eventId: event.eventId,
			title: $.trim(event.title),
			stick: true,
			className: event.className,
			stick: true,
			duration: myDuration
		});
	}
}

function loadCalendar(urlGetConferenceScheduleEvents, confroomschedule_id){
	
	$('#calendar').fullCalendar({
		timezone: 'local',
		header: {
			left:'',
			center: 'title',
			right:''
		},
		allDaySlot: false,
		slotEventOverlap: false,
		height:400,
		eventOverlapping: function(event) {
			return (confirm('Are you sure you want to overlap on other event?'));
		},
		selectable: true,
		defaultView: 'agendaDay',
		editable: true,
		droppable: true,
		dropAccept: '.fc-event',
		defaultTimedEventDuration: '01:00:00',
		forceEventDuration: true,
		drop: function(date, jsEvent, ui) {
			$(this).remove();
		}
		,eventReceive :function(evt){
			console.log('==========  eventReceive  =============');
			console.log(evt);
			console.log('=======================================');
		}
		,eventDragStop: function(evt, jsEvent, ui, view) {
			if (isElemOverDiv($('#external-events'))) {
				console.log('========     eventDragStop::>external-events     ========');
				$('#calendar').fullCalendar('removeEvents', evt._id);
				$('#calendar').fullCalendar('dragRevertDuration', 500);
				$('#external-events').css('border', '');
				var $eventBack = $('<div class=\'fc-event ' + evt.className + '\'>' + evt.title + '</div>');
				makeDataEvent($eventBack, evt);
				makeDraggable($eventBack);
				$('#external-events').append($eventBack);        				
				console.log('==========================================================');
			}
			if(evt.sub_id === undefined)
				if (isElemOverDiv($('#eventTrash'))) {
					console.log('========     eventDragStop::>eventTrash     ========');
					$('#calendar').fullCalendar('removeEvents', evt._id);			
					console.log('====================================================');
				}
		},
		eventDragStart: function(evt, jsEvent, ui, view) {
			eventData = evt;
			console.log(eventData);
			_viewContainer = $('#calendar').find('.fc-view-container');
			_viewContainer.off('mousemove').on('mousemove', function() { 
				var $_externalEvents =$('#external-events');
				if (isElemOverDiv($_externalEvents)) {
					$_externalEvents.css('border', 'red thick solid');
				} else {
					$_externalEvents.css('border', '');
				}
				var $_eventTrash =$('#eventTrash');
				if (isElemOverDiv($_eventTrash)) {
					$_eventTrash.css('border', 'red thick solid');
				} else {
					$_eventTrash.css('border', '');
				}
			});
		},
		eventDrop: function(event, delta, revertFunc) {
			if (event.start.diff(currdate, 'days') !== 0) {
				alert('this is not allowed');
				revertFunc();
			} else {
				if (!confirm("Are you sure about this change?")) {
					revertFunc();
				} else {
					eventData.start = event.start;
					eventData.end = event.end;
				}
			}
		},
		beforeEventDragStop: function() {
			if (isElemOverDiv($('#external-events'))) {
				$('#calendar').fullCalendar('dragRevertDuration', 0);
			}
		},
		select: function(start, end) {
			var title = prompt('Event Title:');
			var eventData;
			if (title) {
				eventData = {
					title: title,
					start: start,
					end: end,
					className: 'custom-event'
				};
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                }
                ,events: function(start, end, timezone, callback) {
                	
                	$.ajax({
                		url: urlGetConferenceScheduleEvents,
                		data:{ scheduleId: confroomschedule_id },
                		success: function(doc) {
                			var arrayToProcess = [];

                			if(doc.conferenceScheduleEvents !== undefined){
                				$.each(doc.conferenceScheduleEvents,function(index,value){                				 
                					value.id = value.eventId;
                					arrayToProcess.push(value);
                				});

                				callback(arrayToProcess);
                			}	
                		}
                	});
                }
            });
}

$(document).off('beforeEventDragStop').on('beforeEventDragStop', function() {
	if (isElemOverDiv($('#external-events')) || isElemOverDiv($('#eventTrash'))) {
		return 0;
	} else {
		return 500;
	}
});

function isElemOverDiv(element) {
	var trashEl = element;
	var ofs = trashEl.offset();
	var x1 = ofs.left;
	var x2 = ofs.left + trashEl.outerWidth(true);
	var y1 = ofs.top;
	var y2 = ofs.top + trashEl.outerHeight(true);
	if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
		currentMousePos.y >= y1 && currentMousePos.y <= y2) {
		return true;
}
return false;
}

