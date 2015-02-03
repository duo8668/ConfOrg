@extends('layouts.dashboard.master')

@section('page-header')
Manage conference : 
@stop
<!-- extrascripts section -->
@section('extraScripts')

<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/icheck/square/green.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/formvalidation/formvalidation.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<script src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}"></script>

<script src="{{ asset('js/icheck/icheck.js') }}"></script>

<script src="{{ asset('js/formvalidation/formvalidation.js') }}"></script>

<script src="{{ asset('js/formvalidation/framework/bootstrap.js') }}"></script>

<script src="{{ asset('js/summernote.js') }}"></script>

<script src="{{ asset('js/bootstrap3-typeahead.js') }}"></script>

<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

<script src="{{ asset('js/conferencecontroller.js') }}"></script>

<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "lucida grande",helvetica,arial,verdana,sans-serif;
		font-size: 14px;
	}

	.date {
		background-color: white;
	}

	.bootstrap-tagsinput .tag{
		font-size: 14px;
	}

	.modal-body {
		max-height: calc(100vh - 110px);
		overflow-y: auto;
	}
</style>

@stop
@section('content')

<style>

	.customborder:hover, .delStaff:hover{ 
		cursor: pointer;
	}

	.delStaff:active{ 
		background-color: #780000 ;
	}

	.divider {
		height: 2px;
		margin: 9px 0;
		overflow: hidden;
		background-color: #e5e5e5;
	}

	.btnEdit{
		padding: 1px 20px;
	}
	.panel-heading {
		cursor: pointer;
	}
	.boldtext{
		font-weight: bolder;
	}
	.conferencebody .title{
		color:#FF7321;
	}
	.conferencebody .venue{
		color:#FF7321;
	}	
	.conferencebody .room{
		color:#FF7321;
	}	
	.conferencebody .date{
		color:#FF7321;
	}
	.staffInfo{
		padding:5px 5px;
	}
</style>

<script type="text/javascript">	
	
	$(document).ready(function() {

		$('#summernote').summernote({
			height: "500px",
			onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0],editor,welEditable);
			}
		}).code($('#descriptionContent').html());

		$('#btnEditDescription').on('click',function(e){
			// raise ajax request here and set text

			$('#descriptionEditor').modal({
				keyboard: false
				,backdrop:'static'
				,show:true }); 
		});

		$('#btnStaffEdit').on('click',function(e){
			// raise ajax request here and set text

			$('#staffEditor').modal({
				keyboard: false
				,backdrop:'static'
				,show:true }); 
		});


		$('#staffEditor').modal({
			keyboard: false
			,backdrop:'static'
			,show:true }); 

		$('[name=staffName]').tagsinput({
			typeahead: {                  
				source: function(query) {
					//alert(query);
					return $.get('http://someservice.com');
				}
			}
		});
		$('#btnSaveDescription').on('click',function(e){
			alert($('#descriptionEditor').code());
		});

	});

	function sendFile(file, editor, weleditable) {
		data = new FormData();
		data.append("image", file);

		$.ajax({ 
			url: "{{ URL::to('utils/uploadImage') }}",			
			type: "POST",
			data : data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(response) {
				if(response.success){
					editor.insertImage(weleditable, response.file);
				}else{

				}

			}
		});
	}

	function showresponse(response, statustext, xhr)  { 

		var res = jquery.parsejson(response);

		if(res.success == false)
		{
			var arr = res.errors;
			$.each(arr, function(index, value)
			{
				if (value.length != 0)
				{
					$("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
				}
			});
			$("#validation-errors").show();
		} else {
			$("#output").html("<img src='"+res.file+"' />");
			$("#output").css('display','block');
		}
	}

</script>

<div class="">
	<div class="row">


		<div id="conf_id_col_{{$conf->conf_id}}" class="col-md-12 confclass">

			<div class="panel-heading"><strong></strong></div>
			<div class="panel-body conferencebody">
				<h2 class="pager title"><u>{{ $conf->title }}</u></h2>
				<h3 class="pager venue"> {{ $conf->room()->venue()->venue_name }}  </h3>
				<h4 class="pager room">  {{ $conf->room()->room_name }}  </h4>
				<h4 class="pager date">  {{ date_format(new DateTime($conf->begin_date), 'd-M-Y')  }} <b>&nbsp;&nbsp;~&nbsp;&nbsp;</b> {{ date_format(new DateTime($conf->end_date), 'd-M-Y') }}  </h4>
			</div>
			<div class="divider"></div>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<!-- Description  -->
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a>
								Description
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							{{ Form::button('Edit', array('class' => 'btn btn-primary btn-xs pull-right btnEdit','id'=>'btnEditDescription')) }}
							<br/>
							<div id='descriptionContent'>
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf  
							</div>							
						</div>
					</div>
				</div>
				<!-- Staff List  -->
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseStaff" aria-expanded="true" aria-controls="v" role="tab" id="headingStaff">
						<h4 class="panel-title">
							<a class="collapsed">
								Staff List
							</a>
						</h4>
					</div>
					<div id="collapseStaff" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingStaff">
						<div class="panel-body">
							{{ Form::button('Edit', array('class' => 'btn btn-primary btn-xs pull-right btnEdit','id'=>'btnStaffEdit')) }}
							<br/>
							<table class="table table-striped">
								<tr>
									<td class="">
										<b>Staff :</b>
									</td>
									<td>
										@foreach($allStaffs as $staff )
										<span  class="staffInfo label label-info">
											{{ $staff->firstname }},{{ $staff->lastname }}
										</span>
										@endforeach
									</td>
								</tr>
							</table>						 
						</div>
					</div>
				</div>
				<!-- Review Panel List  -->
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseReviewPanel" aria-expanded="true" aria-controls="collapseReviewPanel" role="tab" id="headingReviewPanel">
						<h4 class="panel-title">
							<a class="collapsed">
								Review Panel List
							</a>
						</h4>
					</div>
					<div id="collapseReviewPanel" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingReviewPanel">
						<div class="panel-body">
							Current Review Panel List							 
						</div>
					</div>
				</div>
				<!-- Submission  -->
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseSubmission" aria-expanded="false" aria-controls="collapseSubmission" role="tab" id="headingSubmissione">
						<h4 class="panel-title">
							<a class="collapsed">
								Submission List
							</a>
						</h4>
					</div>
					<div id="collapseSubmission" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSubmission">
						<div class="panel-body">
							Submission List
						</div>
					</div>
				</div>
				<!-- Participant  -->
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseParticipants" aria-expanded="false" aria-controls="collapseParticipants" role="tab" id="headingParticipants">
						<h4 class="panel-title">
							<a class="collapsed">
								Participant List
							</a>
						</h4>
					</div>
					<div id="collapseParticipants" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingParticipants">
						<div class="panel-body">
							Participant List
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>

</div>
<!-- Description -->
<div class="col-md-12 modal fade" id="descriptionEditor" tabindex="-1" role="dialog" aria-labelledby="descriptionEditor" aria-hidden="true">
	<div class="col-md-12 modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"  id="descriptionEditor">Edit Description for : </h4>
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
<!-- Staff Panel -->
<div class="col-md-12 modal fade" id="staffEditor" tabindex="-1" role="dialog" aria-labelledby="staffEditor" aria-hidden="true">
	<div class="col-md-12 modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"  id="staffEditor">Edit Staff for : </h4>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class = 'form-horizontal'>
					<div class="form-group">
						{{ Form::label('lblStaff', 'Staff Name :', array('class' => 'col-md-4 control-label')) }}       
						<div class="col-md-4">
							{{ Form::text('staffName',isset($value)?$value:'',array('name'=>'staffName','id'=>'staffName', 'class' => 'form-control necessary',  'data-provide'=>'typeahead', 'autocomplete' =>'off'))}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('lblCurrentStaff', 'Current List :', array('class' => 'col-md-4 control-label')) }} 
						<div class="col-md-4">
							<ul class="list-group">
								@foreach($allStaffs as $staff )
								<li class="list-group-item">
									{{ $staff->firstname }},{{ $staff->lastname }}
									<span class=" delStaff badge" style="background-color:red" id='btnDeleteStaff_{{ $staff->user_id }}'>
										<span class="glyphicon glyphicon-remove">

										</span>

									</span>
								</li>
								@endforeach
							</ul>
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
<!-- Review Panel -->
<div class="col-md-12 modal fade" id="reviewPanelEditor" tabindex="-1" role="dialog" aria-labelledby="reviewPanelEditor" aria-hidden="true">
	<div class="col-md-12 modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"  id="reviewPanelEditor">Edit Review Panel for : </h4>
		</div>
		<div class="modal-body">				
			<div class="form-group">
				<textarea class="input-block-level" id="reviewpanel" name="content" rows="18">
				</textarea>
			</div>
		</div>
		<div class="modal-footer">
			{{ Form::button('Cancel', array('class' => 'btn btn-default btn-sm','data-dismiss' => 'modal')) }}
			{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveReviewPanel')) }}
		</div>
	</div>
</div>
</div>
@stop
