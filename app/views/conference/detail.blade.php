@extends('layouts.dashboard.master')

@section('page-header')
Conference Detail
@stop
<!-- extrascripts section -->
@section('extraScripts')

<!--===================================================================================-->
<!--===========================     CSS     ====================================-->
<!-- Bootstrap DatePicker -->
<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap Checbox -->
<link href="{{ asset('css/icheck/square/green.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap selectboxit -->
<link href="{{ asset('css/selectboxit/selectboxit.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap FormValidation -->
<link href="{{ asset('css/formvalidation/formvalidation.css') }}" rel="stylesheet" type="text/css">
<!-- What You See Is What You Get -->
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css">
<!-- TypeAhead -->
<link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css">

<!-- FullCalendar -->
<link href="{{ asset('css/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<!--===================================================================================-->
<!--===========================     JAVASCRIPT     ====================================-->
<script src="{{ asset('js/fullcalendar/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<!-- Bootstrap DatePicker -->
<script src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}"></script>

<!-- Bootstrap Checbox -->
<script src="{{ asset('js/icheck/icheck.js') }}"></script>

<!-- Bootstrap selectboxit -->
<script src="{{ asset('js/selectboxit/selectboxit.js') }}"></script>

<!-- Bootstrap FormValidation -->
<script src="{{ asset('js/formvalidation/formvalidation.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.js') }}"></script>

<!-- What You See Is What You Get -->
<script src="{{ asset('js/summernote.js') }}"></script>

<!-- TypeAhead -->
<script src="{{ asset('js/bootstrap3-typeahead.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

<!-- FullCalendar -->
<script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>



<!-- Custom App Javascript -->
<script src="{{ asset('js/app/conference/editParticular.js') }}"></script>
<script src="{{ asset('js/app/conference/editDescription.js') }}"></script>
<script src="{{ asset('js/app/conference/editReviewPanel.js') }}"></script>
<script src="{{ asset('js/app/conference/editStaff.js') }}"></script>

<style>

	body {
		/*margin: 40px 10px;*/
		padding: 0;
		font-family: "lucida grande",helvetica,arial,verdana,sans-serif;
		font-size: 14px;
	}

	.date {
		background-color: white;
	}

	.bootstrap-tagsinput .tag{
		font-size: 14px;
		padding: 2px;
		margin: 1px;	
	}
	.bootstrap-tagsinput { 
		min-height: calc(100vh - 350px);
		min-width: 100%;
	}
	.modal-body {
		max-height: calc(100vh - 80px);
		overflow-y: auto;
	}
	
	.note-editor{
		max-height: calc(100vh - 50px);
		overflow-y: auto;
	} 

	#external-events {
		float: left;
		padding: 15px 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}

	#external-events:hover {
		border: green thin solid;
	}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}

	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	.custom-event {
		background-color: yellow;
		color: black;
		font-size: 1em;
	}

	.custom-event:hover {
		color: black;
	}
	/*.fc .fc-ltr .fc-unthemed*/
	/*.fc-view*/

	.fc .fc-ltr .fc-unthemed {
		/* prevents dragging outside of widget */

		width: 100%;
		height:400px;
		overflow: hidden;
	}

	.fc-time-grid-container{
		height:400px;
	}

	.glyphicon {
		margin-top: 10px;
		margin-bottom: 10px;
		font-size: 1.5em;
	}

	#eventTrash{
		text-align: center;
		margin-top:1px;

	}
	.alert-warning:hover {
		color: #8a6d3b;
		background-color: #fcf8e3;
		border-color: #faebcc;
	}

	.alert:hover {
		border: 2px solid;
	}

</style>
<script type="text/javascript">

	var currentMousePos = {  x: - 1, y: - 1 };
	$(document).on("mousemove", function(event) {
		currentMousePos.x = event.pageX;
		currentMousePos.y = event.pageY;
	});

	$(document).ready(function() {

		loadEditParticular({{ $conf -> conf_id }}, "{{ URL::to('conference/management/updateParticulars') }}");
		loadEditDescription({{ $conf -> conf_id }}, "{{ URL::to('conference/management/updateDescription') }}", "{{ URL::to('utils/registerImageUploadConference') }}", "{{ URL::to('utils/uploadImage') }}");
		loadEditStaff({{ $conf -> conf_id }}, "{{ URL::to('users/conference_staffs') }}", "{{ URL::to('conference/management/updateConfStaffs') }}", "{{ URL::to('users/likeany') }}");
		loadEditReviewPanel({{ $conf -> conf_id }}, "{{ URL::to('users/conference_reviewpanels') }}", "{{ URL::to('conference/management/updateReviewPanels') }}", "{{ URL::to('users/likeany') }}");

		$('.modal').on('shown.bs.modal',function(e){
			if($(this).children('div:eq(1)').hasClass('modal-dialog')){
				$(this).children('div:eq(1)').removeClass('modal-dialog');
			}
			var $innerModal = $(this).find('.innerModal');
			$innerModal.css('top',($(window).height()-$innerModal.height())/2);

			var widthPercent = $innerModal.css('width');
			$innerModal.css('left',($(window).width()-$innerModal.outerWidth())/2);
		});

		$('.modal').on('show.bs.modal',function(e){

			var $innerModal = $(this).find('.innerModal');
			$innerModal.css('top',($(window).height()-$innerModal.height())/2);

			var widthPercent = $innerModal.css('width');
			$innerModal.css('left',($(window).width()-$innerModal.outerWidth())/2);
		});


		$('.modal').on('hide.bs.modal',function(e){
			if(!$(this).children('div:eq(1)').hasClass('modal-dialog')){
				$(this).children('div:eq(1)').addClass('modal-dialog');
			}
		});


		var currdate,eventData;
		var _viewContainer, notifyTimer = null;

		$('#btnEditSchedule').on('click', function (e) {

			//* id=scheduleContent
			//* id=scheduleEditor
			// 2. Load Available Submissions into #external-events
			$.ajax({
				url: "{{ URL::to('conference/conferenceEvents/getAvailableConferenceScheduleEvents/') }}",
				data:{ scheduleId: {{ $conf->ConferenceRoomSchedule()->confroomschedule_id }} },
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

			$('#external-events').html($('#external-events').children().first()); 
			$('#scheduleEditor').modal({
				keyboard: false
				, backdrop: 'static'
				, show : true
			}); 
		});

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

		$('#scheduleEditor').on('beforeShown.bs.modal',function(e){
			currdate = moment($('#ddlscheduleConferenceDate').val());
			loadCalendar();
			$('#external-events').css('min-width',$('#external-events').width());
			$('#eventTrash').css('min-width',$('#external-events').width());
			$('#calendar').fullCalendar('gotoDate',$('#ddlscheduleConferenceDate').val()); 
		});

		$('#scheduleEditor').on('hide.bs.modal',function(e){
			$('#calendar').fullCalendar('destroy');
			$('#external-events').html($('#external-events').children().first());
		});

        //* Save :: id=btnSaveSchedule
        //* Save
        $('#btnSaveSchedule').off('click').on('click', function (e) {

        	var dataArray =$('#calendar').fullCalendar('clientEvents'), arrayToSubmit = [];


        	$.each(dataArray,function(index,value){
        		console.log(value);


        		var innerData = { eventId:value.eventId ,sub_id: value.sub_id, title:value.title, start:value.start.format('YYYY-MM-DD HH:mm:ss'), end: value.end.format('YYYY-MM-DD HH:mm:ss'), className: value.className };
        		arrayToSubmit.push(innerData);
        	});

        	$.ajax({url: "{{ URL::to('conference/conferenceEvents/addConferenceScheduleEvents/') }}"
        		, data: { scheduleId: {{ $conf->ConferenceRoomSchedule()->confroomschedule_id }}, allEvents: arrayToSubmit }
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
					$('#resultModal').modal('hide');
				}, 1000);
			});
		});

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

        function loadCalendar(){
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
        			if (isElemOverDiv($('#eventTrash'))) {
        				console.log('========     eventDragStop::>eventTrash     ========');
        				$('#calendar').fullCalendar('removeEvents', evt._id);			
        				console.log('====================================================');
        			}
        		},
        		eventDragStart: function(event, jsEvent, ui, view) {
        			eventData = event;
        			_viewContainer = $('#calendar').find('.fc-view-container');
        			_viewContainer.off('mousemove').on('mousemove', function() { 
        				var $_externalEvents =$('#external-events');
        				if (isElemOverDiv($_externalEvents)) {
        					$_externalEvents.css('border', 'red thick solid');
        				} else {
        					$_externalEvents.css('border', '');
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
                		url: "{{ URL::to('conference/conferenceEvents/getConferenceScheduleEvents/') }}",
                		data:{ scheduleId: {{ $conf->ConferenceRoomSchedule()->confroomschedule_id }} },
                		success: function(doc) {
                			var arrayToProcess = [];

                			$.each(doc.conferenceScheduleEvents,function(index,value){                				 
                				value.id = value.eventId;
                				arrayToProcess.push(value);
                			});

                			callback(arrayToProcess);
                		}
                	});
                }
            });
		}

		$(document).on('beforeEventDragStop', function() {
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
});

$.fn.textWidth = function() {
	var html_org = $(this).html();
	console.log( $(this).html());
	var html_calc = '<span>' + html_org + '</span>';
	$(this).html(html_calc);
	var width = $(this).find('span:first').width();
	$(this).html(html_org);
	return width;
}

</script>
@stop

@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
	<li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
	<li class="active">{{ $conf->title }}</li>
</ol>
<hr>

<div class="row">
	<div class="col-md-12">
		<div id="conf_id_col_{{$conf->conf_id}}" class="confclass">
			<div class="conferencebody">

				<h3 class="text-center"><u>{{ $conf->title }}</u></h2>
					<h4 class="text-center"> {{ $conf->room()->venue()->venue_name }}  </h4>
					<!-- <h4>  {{ $conf->room()->room_name }}  </h4> -->
					<h4 class="text-center">  <span id="beginDate">{{ date_format(new DateTime($conf->begin_date), 'd-M-Y')  }}</span> <b>&nbsp;&nbsp;~&nbsp;&nbsp;</b> {{ date_format(new DateTime($conf->end_date), 'd-M-Y') }}  </h4>

					<!-- SUBMIT PAPER BUTTON  -->
					<div class="row">
						<div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
							<a href="{{ URL::route('submission.add', ['conf_id' => $conf->conf_id]) }}" class="btn btn-primary btn-block" role="button">Submit Paper</a>
						</div>
					</div>
					<!-- BELOW INFO ONLY VISIBLE TO CHAIRMAN -->

					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<hr>
							<!-- Submission Title-->
							<div class="row">
								<label class="col-md-6 control-label text-right">Chairman</label>       
								<div class="col-md-6">
									@foreach($confChairUsers as $confChairUser)
									{{  $confChairUser['firstname'] }},  {{ $confChairUser['lastname'] }}
									@endforeach
								</div>
							</div>

							<!-- Abstract -->
							<div class="row">
								<label class="col-md-6 control-label text-right">Submission Deadline</label>
								<div class="col-md-6">   
									<span id="cutOffValue">{{ date_format(new DateTime($conf->cutoff_time), 'd-M-Y H:i') }}</span>        
								</div>
							</div>

							<!-- Topics -->
							<div class="row">
								<label class="col-md-6 control-label text-right">Minimum Acceptance Score</label> 
								<div class="col-md-6">
									<span  id="minScoreValue">{{ $conf->min_score }}</span>
								</div>
							</div>

						</div>
					</div>
					{{ Form::button('Edit Conference Details', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnEditParticular')) }}
					<!-- END CHAIRMAN INFO -->

				</div>
				<div style="margin-bottom: 30px;"></div>


				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
						<li role="presentation" class="active"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">Schedule</a></li>
						<li role="presentation"><a href="#topics" aria-controls="topics" role="tab" data-toggle="tab">Topics</a></li>
						<li role="presentation"><a href="#committee" aria-controls="committee" role="tab" data-toggle="tab">Committee</a></li>
						<li role="presentation"><a href="#reviewer" aria-controls="reviewer" role="tab" data-toggle="tab">Reviewers</a></li>
						<li role="presentation"><a href="#submissions" aria-controls="submissions" role="tab" data-toggle="tab">Submissions</a></li>
						<li role="presentation"><a href="#participants" aria-controls="participants" role="tab" data-toggle="tab">Participants</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">

						<!-- Description -->
						<div role="tabpanel" class="tab-pane fade" id="description">
							{{ Form::button('Edit Conference Description', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnEditDescription')) }}
							<div class="clearfix"></div>

							<div id='descriptionContent'>
								{{ $conf->description  }}
							</div>	
						</div>

						<!-- Description -->
						<div role="tabpanel" class="tab-pane fade in active" id="schedule">
							{{ Form::button('Edit Schedule', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnEditSchedule')) }}
							<div class="clearfix"></div>

							<div id='scheduleContent'>

							</div>	
						</div>

						<!-- Topics -->
						<div role="tabpanel" class="tab-pane fade" id="topics">
							[[ TOPICS HERE ]]
						</div>

						<!-- Committee -->
						<div role="tabpanel" class="tab-pane fade" id="committee">
							{{ Form::button('Edit Committee', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnStaffEdit')) }}
							<div class="clearfix"></div>

							<table class="table table-striped">
								<tr>
									<td class='col-md-2'>
										<b>Committee Members</b>
									</td>
									<td class='col-md-8'>
										<div id="allStaffContainer">
											@foreach($allStaffs as $staff)
											<span  class='staffInfo label label-info'  style='color:black;margin:2px;'>
												{{  $staff['firstname'] }},  {{ $staff['lastname'] }}
											</span>
											@endforeach
										</div>
									</td>
								</tr>
							</table>
						</div>

						<!-- Reviewer -->
						<div role="tabpanel" class="tab-pane fade" id="reviewer">
							{{ Form::button('Edit Reviewers', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnReviewPanelEdit')) }}
							<div class="clearfix"></div>

							<table class="table table-striped">
								<tr>
									<td class='col-md-2'>
										<b>Peer Reviewers</b>
									</td>
									<td class='col-md-8'>
										<div id="allReviewPanelContainer">
											@foreach($reviewPanels as $reviewpanel)
											<span  class='staffInfo label label-info'  style='color:black;margin:2px;'>
												{{  $reviewpanel['firstname'] }},  {{ $reviewpanel['lastname'] }}
											</span>
											@endforeach
										</div>
									</td>
								</tr>
							</table>	
						</div>

						<!-- Submissions -->
						<div role="tabpanel" class="tab-pane fade" id="submissions">
							<div class="table-responsive">
								<table class="table">   
									<tr>
										<td><strong>Submission Title</strong></td>
										<td><strong>Type</strong></td>
										<td><strong>Date Submitted</strong></td>
										<td><strong>Status</strong></td>
										<td><strong>Option</strong></td>
									</tr> 
								</table>
							</div>
						</div>

						<!-- Participants -->
						<div role="tabpanel" class="tab-pane fade" id="participants">
							[PARTICIPANTS HERE]
						</div>
					</div>

				</div> <!-- END TAB PANEL -->


			</div>
		</div>

	</div>
	<!-- Description -->
	<div class="modal fade" id="descriptionEditor" tabindex="-1" role="dialog" aria-labelledby="descriptionEditor" aria-hidden="true">
		<div class="innerModal col-md-10 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lbldescriptionEditor">Edit Description for : </h4>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<textarea class="input-block-level" id="summernote" name="content" rows="18">
						</textarea>
					</div>
				</div>
				<div class="modal-footer">			 
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveDescription')) }}
				</div>
			</div>
		</div>
	</div>

	<!-- Staff Panel -->
	<div class="col-md-12 modal fade" id="staffEditor" tabindex="-1" role="dialog" aria-labelledby="staffEditor" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lblstaffEditor">Edit Staff for : </h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class = 'form-horizontal'>
							<div class="form-group">
								{{ Form::label('lblStaff', 'Staff Email :', array('class' => 'col-md-4 control-label')) }}       
								<div class="col-md-8">
									<div id="staffName">
										<div class="necessary" id="innerStaffName">
											<textarea name="emails" class="form-control" cols="200" rows="10"></textarea>
										</div>
									</div>

								</div>
							</div>

						</div>
					</fieldset>				

				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveStaff')) }}
				</div>
			</div>
		</div>
	</div>

	<!-- Review Panel -->
	<div class="col-md-12 modal fade" id="reviewPanelEditor" tabindex="-1" role="dialog" aria-labelledby="reviewPanelEditor" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lblreviewPanelEditor">Edit Review Panel for : </h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class = 'form-horizontal'>
							<div class="form-group">
								{{ Form::label('lblReviewPanel', 'Review Panel Email :', array('class' => 'col-md-3 control-label')) }}       
								<div class="col-md-9">
									<div id="reviewPanel">
										<div class="necessary" id="innerReviewPanel">
											<textarea name="emails" class="form-control" cols="250" rows="10"></textarea>
										</div>
									</div>

								</div>
							</div>

						</div>
					</fieldset>	
				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveReviewPanel')) }}
				</div>
			</div>
		</div>
	</div>

	<!-- Particular -->
	<div class="col-md-12 modal fade" id="particularEditor" tabindex="-1" role="dialog" aria-labelledby="particularEditor" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lblparticularEditor">Edit Particular for : </h4>
				</div>
				<div class="modal-body" id="confParticularField">
					<fieldset>
						<div class = 'form-horizontal'>
							<div class="form-group">
								{{ Form::label('lblCutOffDate', 'Cuf Off :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4 dateContainer">
									<div class="input-group date" id="innerCutOffDate">
										{{ Form::text('cutoffdate',isset($value)?$value:'',array('name'=>'cutoffdate','id'=>'cutoffdate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY HH:mm')) }}
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblMinScore', 'Min Score :', array('class' => 'col-md-4 control-label')) }}       
								<div class="col-md-4">
									<div id="minScore">
										<div class="necessary" id="innerMinScore">
											<input type="text" name="minScore" class="form-control"/>
										</div>
									</div>

								</div>
							</div>
						</div>
					</fieldset>	
				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveConfParticular')) }}
				</div>
			</div>
		</div>
		
	</div>

	<!-- Schedule -->
	<div class="col-md-12 modal fade" id="scheduleEditor" tabindex="-1" role="dialog" aria-labelledby="scheduleEditor" aria-hidden="true">
		<div class="innerModal col-md-10 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lblScheduleEditor">Edit Schedule for : </h4>
				</div>
				<div class="modal-body" id="confScheduleField">
					<fieldset>
						<div class = 'form-horizontal'>
							<div class="form-group">
								{{ Form::label('lblDates', 'Conference Date :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-6">
									<div id="scheduleConferenceDate">
										<div class="necessary" id="innerScheduleDate">                                    
											{{ Form::select('scheduleConferenceDate', $conf->ConferenceRoomSchedule()->ScheduleDates(),null,array('id'=>'ddlscheduleConferenceDate','class' => 'form-control col-md-3 necessary')) }}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div id='external-events'class="alert alert-success" role="alert">
										<h4>Available Submissions</h4>
										<div class='fc-event'>My Event 1</div>
										<div class='fc-event'>My Event 2</div>
										<div class='fc-event'>My Event 3</div>
										<div class='fc-event'>My Event 4</div>
										<div class='fc-event'>My Event 5</div>
									</div>
									<div id="eventTrash" class="alert alert-warning" role="alert">
										<span class="glyphicon glyphicon-trash"></span>
									</div>									
								</div> 
								<div class="col-md-9">
									<div id="calendar"></div>
								</div>


							</div>
						</div>
					</fieldset>	
				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveSchedule')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="innerModal modal-dialog  col-md-6">
			<div class="modal-content">
				<div class="modal-header">			 
					<h4 class="modal-title" id="exampleModalLabel"></h4>
				</div>
				<div class="modal-body">				
					<div class="form-group pager">
						<label class="control-label"><img src="{{asset('img/jqueryui/ajax-loader.gif')}}"></label>
						<label class="control-label" id="modalMessage"></label>
					</div>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	@stop
