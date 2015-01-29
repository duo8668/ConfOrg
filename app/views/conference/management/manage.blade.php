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

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<script src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}"></script>

<script src="{{ asset('js/icheck/icheck.js') }}"></script>

<script src="{{ asset('js/formvalidation/formvalidation.js') }}"></script>

<script src="{{ asset('js/formvalidation/framework/bootstrap.js') }}"></script>

<script src="{{ asset('js/summernote.js') }}"></script>

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
	

	ul {
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.list li {
		position: relative;
		padding-bottom: 10px;
	}

	#frmcreateconf .checkbox label {
		padding-left: 0;
	}

	#frmcreateconf .datecontainer .form-control-feedback {
		top: 0;
		right: -15px;
	}

	#frmcreateconf .venuecontainer .form-control-feedback {
		top: 0;
		right: -15px;
	}
</style>

@stop
@section('content')

<style>

	.customborder:hover{ 
		cursor: pointer;
	}
	.divider {
		height: 2px;
		margin: 9px 0;
		overflow: hidden;
		background-color: #e5e5e5;
	}

	.btnEditDesc{
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
							{{ Form::button('Edit', array('class' => 'btn btn-primary btn-xs pull-right btnEditDesc','id'=>'btnEditDescription')) }}
							<br/>
							<div id='descriptionContent'>
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf  
							</div>							
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed">
								Review Panel List
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							Review Panel List

							Review Panel List

							Review Panel List
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a class="collapsed">
								Submission List
							</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							Submission List
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" role="tab" id="headingFour">
						<h4 class="panel-title">
							<a class="collapsed">
								Participant List
							</a>
						</h4>
					</div>
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
							Participant List
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>

</div>
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
</div>
@stop
