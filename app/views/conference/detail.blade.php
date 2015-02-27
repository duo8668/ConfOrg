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
<script src="{{ asset('js/app/conference/editSchedule.js') }}"></script>
<script src="{{ asset('js/app/conference/editTopic.js') }}"></script>

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
		max-height: 20em;	
		margin-top: 4em;
		margin-bottom: 0px;
		overflow: scroll;
		z-index: 10;
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

	.glyphicon-trash {
		margin-top: 10px;
		margin-bottom: 10px;
		font-size: 1.5em;
	}

	#eventTrash{
		text-align: center;
		margin-top:1px;
		padding: 0px;
		padding-bottom: 5px;
		z-index: 8;
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

		loadEditSchedule("{{ URL::to('conference/conferenceEvents/getAvailableConferenceScheduleEvents/') }}"
			,{{ $conf->ConferenceRoomSchedule()->confroomschedule_id }}
			,"{{ URL::to('conference/conferenceEvents/addConferenceScheduleEvents/') }}"
			,"{{ URL::to('conference/conferenceEvents/getConferenceScheduleEvents/') }}");

		loadEditTopic({{ $conf -> conf_id }}, "{{ URL::to('conference/management/updateTopics') }}");
		loadAddTopic({{ $conf -> conf_id }},"{{ URL::to('conference/management/addNewTopic') }}")

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
{{ HTML::script('js/filterables.js') }}
<div class="row">
	<div class="col-md-12">
		<div id="conf_id_col_{{$conf->conf_id}}" class="confclass">
			<div class="conferencebody">
				
				<div class="row">
					<div class="col-md-12">
						<!-- Conference Title-->
						<div class="row">
							<label class="col-md-3 control-label text-right">Conference Title</label>       
							<div class="col-md-9">
								{{ $conf->title }}
							</div>
						</div>

						<!-- Venue name -->
						<div class="row">
							<label class="col-md-3 control-label text-right">Venue</label>       
							<div class="col-md-9">
								{{ $conf->room()->venue()->venue_name }}
							</div>
						</div>

						<!-- Date commence and end -->
						<div class="row">
							<label class="col-md-3 control-label text-right">Begin and End Date</label>       
							<div class="col-md-9">
								<span id="beginDate">{{ date_format(new DateTime($conf->begin_date), 'd-M-Y')  }}</span> <b>&nbsp;&nbsp;~&nbsp;&nbsp;</b> {{ date_format(new DateTime($conf->end_date), 'd-M-Y') }}
							</div>
						</div>

						<!-- Chairman -->
						<div class="row">
							<label class="col-md-3 control-label text-right">Chairman</label>       
							<div class="col-md-9">
								@foreach($confChairUsers as $confChairUser)
								{{  $confChairUser['firstname'] }},  {{ $confChairUser['lastname'] }}
								@endforeach
							</div>
						</div>

						<div class="row">
							<label class="col-md-3 control-label text-right">Submission Deadline</label>
							<div class="col-md-9">   
								<span id="cutOffValue">{{ date_format(new DateTime($conf->cutoff_time), 'd-M-Y H:i') }}</span>        
							</div>
						</div>

						<div class="row">
							<label class="col-md-3 control-label text-right">Minimum Acceptance Score</label> 
							<div class="col-md-9">
								<span  id="minScoreValue">{{ $conf->min_score }}</span>
							</div>
						</div>

						<div class="row">
							<label class="col-md-3 control-label text-right">Ticket Price</label> 
							<div class="col-md-9">
								<span  id="ticketPriceValue"> S$ {{ $conf->ticket_price }}</span>
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

					<!-- Schedule -->
					<div role="tabpanel" class="tab-pane fade in active" id="schedule">
						{{ Form::button('Edit Schedule', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnEditSchedule')) }}
						<div class="clearfix"></div>

						<div id='scheduleContent'>
							<div id='publicCalendar'></div>

						</div>	
					</div>

					<!-- Topics -->
					<div role="tabpanel" class="tab-pane fade" id="topics">
						{{ Form::button('Edit Topics', array('class' => 'btn btn-info btn-sm pull-right btnEdit','id'=>'btnTopicsEdit')) }}
						{{ Form::button('Add New Topic', array('class' => 'btn btn-success btn-sm pull-right btnEdit','id'=>'btnTopicsAdd')) }}
						@if (count($topics) > 0)
						<table class="table table-striped">
							<tr>
								<td style="width:30%"><strong>Topic Name</strong></td>
								<td style="width:30%"><strong>No. of Submissions Under This Topic</strong></td>
							</tr>
							@foreach($topics as $topic)
							<tr>
								<td style="width:30%">{{{ $topic->topic_name }}}</td>
								<td style="width:30%">{{{ $topic->total_subs }}}</td>
							</tr>
							@endforeach
						</table>
						@else
						No topics defined
						@endif
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

						<div class="row filter-row">
							<div class="panel panel-default filterable">
								<div class="panel-heading">
									<h3 class="panel-title"><strong>Filter Submissions</strong></h3>
									<div class="pull-right">
										<button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr class="filters">
												<th style="width: 25%;"><input type="text" class="form-control" placeholder="Submission Title" disabled></th>
												<th style="width: 10%;"><input type="text" class="form-control" placeholder="Type" disabled></th>
												<th style="width: 15%;"><input type="text" class="form-control" placeholder="Date Submitted" disabled></th>
												<th style="width: 10%;"><input type="text" class="form-control" placeholder="Score" disabled></th>
												<th style="width: 10%;"><input type="text" class="form-control" placeholder="Status" disabled></th>
												<th>Option</th>
											</tr>
										</thead>   

										@foreach ($submissions as $sub) 
										<tr>
											<td>{{ link_to_route('review.show', $sub->sub_title, [$sub->sub_id], null) }}</td>
											<td>
												@if ($sub->sub_type === 3)
												Poster
												@elseif ($sub->sub_type === 2)
												Full Paper
												@else
												Abstract
												@endif
											</td>
											<td>{{ date("d F Y",strtotime($sub->created_at)) }} at {{ date("g:ha",strtotime($sub->created_at)) }}</td>

											<td>{{{ $sub->overall_score }}} </td>
											<td>
												@if ($sub->status === 1)
												<span class="text-success">Accepted</span>
												@elseif ($sub->status === 9)
												<span class="text-danger">Rejected</span>
												@else
												On review
												@endif
											</td>
											<td>
												{{ Form::open(['route' => ['submission.veto', $sub->sub_id], 'method' => 'put', 'class' => 'horizontal' ]) }}
												<div class="col-sm-9">
													{{Form::select('chair_decision', 
														array('1' => 'Manually Accept'
															, '9' => 'Manually Reject'
															, '0' => 'Need to Peer-review again')
														, '1'
														, ['class' => 'form-control input-sm']);}}
													</div>
													{{ Form::hidden('conf_id', $conf->conf_id) }}
													{{ Form::button('change', ['type' => 'submit', 'class' => 'btn btn-default btn-sm'])}}
													{{ Form::close() }}
												</td>
											</tr>
											@endforeach
										</table>
									</div>
								</div>
							</div>
						</div>

						<!-- Participants -->
						<div role="tabpanel" class="tab-pane fade" id="participants">
							<div class="row filter-row">
								<div class="panel panel-default filterable">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Filter Participants</strong></h3>
										<div class="pull-right">
											<button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr class="filters">
													<th style="width: 15%;"><input type="text" class="form-control" placeholder="Invoice # " disabled></th>
													<th style="width: 25%;"><input type="text" class="form-control" placeholder="Participant Name" disabled></th>
													<th style="width: 15%;"><input type="text" class="form-control" placeholder="No. of Tickets" disabled></th>
													<th style="width: 15%;"><input type="text" class="form-control" placeholder="Total Amount" disabled></th>
												</tr>
											</thead>   

											@foreach ($invoices as $$inv) 
											<tr>
												<td>{{{ $inv->invoice_id}}}</td>
												<td>{{{ $inv->user()->firstname }}} {{{ $inv->user()->lastname }}}</td>
												<td>${{{ $inv->quantity }}}</td>
												<td>${{{ $inv->total }}}</td>
											</tr>
											@endforeach
										</table>
									</div>
								</div>
							</div>
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
	
	<!-- EDIT Topics -->
	<div class="col-md-12 modal fade" id="topicsEditor" tabindex="-1" role="dialog" aria-labelledby="topicsEditor" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="lblreviewPanelEditor">Edit Topics:</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<form class="form-inline" id="edit_topics_form">
							<table class="table table-striped">
								<tr>
									<td style="width:50%"><strong>Edit Topic Name</strong></td>
									<td><strong>Delete this topic?</strong> <small>(Submissions under this topic will not be removed)</small></td>
								</tr>
								@foreach ($topics as $topic)
								<tr>
									<td>
										<input type="text" value="{{{ $topic->topic_name }}}" class="form-control" style="width:100%" name="topic_name[]" required>
										<input type="hidden" name="topic_id[]" value="{{{ $topic->topic_id }}}">
									</td>
									<td>
										<label><input type="checkbox" name="delete_topic[]" value="{{{ $topic->topic_id }}}"> Mark for deletion</label>
									</td>
								</tr>
								@endforeach

							</table>
						</form>
					</fieldset>	
				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveTopics')) }}
				</div>
			</div>
		</div>
	</div>

	<!-- ADD Topics -->
	<div class="col-md-12 modal fade" id="newTopicsEditor" tabindex="-1" role="dialog" aria-labelledby="newTopicsEditor" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="lblreviewPanelEditor">Add new Topic</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<form class="form-inline" id="add_topics_form">
							<table class="table table-striped">
								<tr>
									<td style="width:25%"><strong>New Topic</strong></td>
									<td>
										<input type="text"  name="topic_name" class="form-control" id="new_topic_name" placeholder="Enter New Topic here" style="width:100%">
										<input type="hidden" name="conf_id" value="{{{ $conf->conf_id }}}">
									</td>
								</tr>
							</table>
						</form>
					</fieldset>	
				</div>
				<div class="modal-footer">
					{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
					{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnAddTopic')) }}
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
								{{ Form::label('lblCutOffDate', 'Submission Deadline', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4 dateContainer">
									<div class="input-group date" id="innerCutOffDate">
										{{ Form::text('cutoffdate',isset($value)?$value:'',array('name'=>'cutoffdate','id'=>'cutoffdate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY HH:mm')) }}
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblMinScore', 'Minimum Acceptance Score', array('class' => 'col-md-4 control-label')) }}       
								<div class="col-md-4">
									<div id="minScore">
										<div class="necessary" id="innerMinScore">
											<input type="text" name="minScore" class="form-control"/>
										</div>
									</div>

								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblTicketPrice', 'Ticket Price', array('class' => 'col-md-4 control-label')) }}  
								<div class="col-md-4">
									<div id="ticketPrice">
										<div class="necessary" id="innerTicketPrice">
											<input type="text" name="ticketPrice" class="form-control"/>
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
								<div class="col-md-12">
									<div class="center-block" style="width:auto;"> 
										{{ Form::label('lblDates', 'Conference Date :', array('class' => 'col-md-4 control-label')) }}
										<div id="scheduleConferenceDate">
											<div class="necessary" id="innerScheduleDate">                                    
												{{ Form::select('scheduleConferenceDate', $conf->ConferenceRoomSchedule()->ScheduleDates(),null,array('id'=>'ddlscheduleConferenceDate','class' => 'form-control col-md-3 necessary')) }}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-3">
										<div id='external-events'class="col-md-12 alert alert-success" role="alert">
											<h4>Available Submissions</h4>
										</div>
										<div class="clearfix"></div>
										<div id="eventTrash" class="col-md-12 alert alert-warning" role="alert">
											<span class="glyphicon glyphicon-trash"></span>
										</div>									
									</div>

									<div class="col-md-9">
										<div id="calendar"></div>
									</div>
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
