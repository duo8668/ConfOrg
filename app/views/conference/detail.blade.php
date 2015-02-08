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
		padding: 2px;
		margin: 1px;	
	}
	.bootstrap-tagsinput { 
		min-height: calc(100vh - 350px);
	}
	.modal-body {
		max-height: calc(100vh - 150px);
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
	.bootstrap-tagsinput {
		width: 100%;
	}
</style>

<script type="text/javascript">	
	
	$(document).ready(function() {

		$('#summernote').summernote({
			height: 'calc(100vh - 210px)',
			onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0],editor,welEditable);
			}
		}).code($('#descriptionContent').html());

		$('#btnEditDescription').on('click',function(e){
			// raise ajax request here and set text
			$('#summernote').code($('#descriptionContent').html());
			$('#descriptionEditor').modal({
				keyboard: false
				,backdrop:'static'
				,show:true }); 
		});

		$('#btnStaffEdit').on('click',function(e){
			// raise ajax request here and set text
			$('#staffName > > [name=emails]').tagsinput('removeAll');

			$.ajax({url:"{{ URL::to('users/conference_staffs') }}"
				,data:{ conf_id:{{ $conf->conf_id }} }
				,type:'get'
				,beforeSend:function(){
					$('#modalMessage').html('Loading...');
					$('#resultModal').modal({
						keyboard: false
						,backdrop:'static' });   
				}
			}) 
			.done(function(data){

				$.each(data,function(key,value){
					$('#staffName > > [name=emails]').tagsinput('add', value);
				}); 
				setTimeout(function(){ $('#resultModal').modal('hide');$('#staffEditor').modal({ keyboard: false,backdrop:'static',show:true }); },1000);				 
			})
			.fail(function(data){
				if(data.responseJSON !== undefined){
					if(data.responseJSON.error !== undefined ){
						var message = data.responseJSON.error.type + ' : '+ data.responseJSON.error.message;
						$('#modalMessage').html(message);
						setTimeout(function(){$('#resultModal').modal('hide');},1500);
					}
				}				
			});
		});

		//

		$('#btnReviewPanelEdit').on('click',function(e){
			// raise ajax request here and set text
			$(this).find('#reviewPanel > > [name=emails]').tagsinput('removeAll');

			$.ajax({url:"{{ URL::to('users/conference_reviewpanels') }}"
				,data:{ conf_id:{{ $conf->conf_id }} }
				,type:'get'
				,beforeSend:function(){
					$('#modalMessage').html('Loading...');
					$('#resultModal').modal({
						keyboard: false
						,backdrop:'static' });   
				}
			}) 
			.done(function(data){

				$.each(data,function(key,value){
					$('#reviewPanel > > [name=emails]').tagsinput('add', value);
				}); 
				setTimeout(function(){ $('#resultModal').modal('hide');$('#reviewPanelEditor').modal({ keyboard: false,backdrop:'static',show:true }); },1000);				 
			})
			.fail(function(data){
				if(data.responseJSON !== undefined){
					if(data.responseJSON.error !== undefined ){
						var message = data.responseJSON.error.type + ' : '+ data.responseJSON.error.message;
						$('#modalMessage').html(message);
						setTimeout(function(){$('#resultModal').modal('hide');},1500);
					}
				}				
			});
		});

$('#staffName').formValidation({
	framework: 'bootstrap',
	excluded: ':disabled',
	err: {
		container: 'tooltip'
	}, 
	icon: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		emails:{
			validators:{
				callback: {
					message: 'Invalid emails',
					callback: function (value, validator, $field) {
                                // Determine the numbers which are generated in captchaOperation
                                var ok = true;
                                var regexp = RegExp(/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+\]))/);
                                var options = validator.getFieldElements('emails').tagsinput('items');
                                var errEmails='Invalid emails are ';
                                $.each(options,function(key,val){

                                	if(!regexp.test(val)){
                                		errEmails += '\'' + val + '\' ,  ';
                                		ok = false;
                                	}
                                }); 

                                return {valid:ok,message:errEmails};
                            }
                        }
                    }
                }
            }
        }).on('err.field.fv err.validator.fv', function(e, data) {
        	$('#btnSaveStaff').prop('disabled', true);
        }).on('success.field.fv', function(e, data) {
        	$('#btnSaveStaff').prop('disabled',false);
        }).find('[name=emails]').tagsinput({
        	typeahead: {
        		maxTags: 3,
        		trimValue: true,
        		source: function(query) {

        			return $.ajax({url:'../../users/likeany'
        				,data:{partialname:query, conf_id:{{ $conf->conf_id }}}
        				,type:'get'});
        		}
        	}
        });

        
        $('#reviewPanel').formValidation({
        	framework: 'bootstrap',
        	excluded: ':disabled',
        	err: {
        		container: 'tooltip'
        	}, 
        	icon: {
        		valid: 'glyphicon glyphicon-ok',
        		invalid: 'glyphicon glyphicon-remove',
        		validating: 'glyphicon glyphicon-refresh'
        	},
        	fields: {
        		emails:{
        			validators:{
        				callback: {
        					message: 'Invalid emails',
        					callback: function (value, validator, $field) {
                                // Determine the numbers which are generated in captchaOperation
                                var ok = true;
                                var regexp = RegExp(/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+\]))/);
                                var options = validator.getFieldElements('emails').tagsinput('items');
                                var errEmails='Invalid emails are ';
                                $.each(options,function(key,val){

                                	if(!regexp.test(val)){
                                		errEmails += '\'' + val + '\' ,  ';
                                		ok = false;
                                	}
                                }); 

                                return {valid:ok,message:errEmails};
                            }
                        }
                    }
                }
            }
        }).on('err.field.fv err.validator.fv', function(e, data) {
        	$('#btnSaveReviewPanel').prop('disabled', true);
        }).on('success.field.fv', function(e, data) {
        	$('#btnSaveReviewPanel').prop('disabled',false);
        }).find('[name=emails]').tagsinput({
        	typeahead: {
        		maxTags: 3,
        		trimValue: true,
        		source: function(query) {

        			return $.ajax({url:'../../users/likeany'
        				,data:{partialname:query, conf_id:{{ $conf->conf_id }}}
        				,type:'get'});
        		}
        	}
        });

        $('#staffName').find('[name=emails]').on('change',function(){
        	var field = $(this).attr('name');

        	$('#staffName').formValidation('revalidateField', field);
        });

        $('#reviewPanel').find('[name=emails]').on('change',function(){
        	var field = $(this).attr('name');

        	$('#reviewPanel').formValidation('revalidateField', field);
        });

        $('#btnSaveDescription').on('click',function(e){
        	$.ajax({url:'updateDescription'
        		,data:{conf_id:{{ $conf->conf_id }},description:$('#summernote').code()}
        		,type:'get'
        		,beforeSend:function(){
        			$('#modalMessage').html('Loading...');
        			$('#resultModal').modal({
        				keyboard: false
        				,backdrop:'static' });   
        		}
        	}) 
        	.done(function(data){
				//change the current
				var message ='Record updated successfully !!!';
				$('#modalMessage').html(message);
				$('#descriptionContent').html($('#summernote').code());
				setTimeout(function(){ $('#resultModal').modal('hide'); $('#descriptionEditor').modal('hide');},1000);				 
			})
        	.fail(function(data){

        		if(data.responseJSON !== undefined){
        			if(data.responseJSON.error !== undefined ){
        				var message = data.responseJSON.error.type + ' : '+ data.responseJSON.error.message;
        				$('#modalMessage').html(message);
        				setTimeout(function(){$('#resultModal').modal('hide');},1500);
        			}
        		}
        	});
        });

$('#btnSaveStaff').on('click',function(e){ 

	$.ajax({url:'updateConfStaffs'
		,data:{conf_id:{{ $conf->conf_id }},emails:$('#staffName').find('[name=emails]').tagsinput('items')}
		,type:'get'
		,beforeSend:function(){
			$('#modalMessage').html('Loading...');
			$('#resultModal').modal({
				keyboard: false
				,backdrop:'static' });   
		}}).done(function(data){
				//change the current
				if(data.success !== undefined){
					var message = data.success.numRowUpdated +' record(s) updated successfully !!!';
					$('#modalMessage').html(message);
					$('#allStaffContainer').html('');

					if(data.success.conStaffs !== undefined){
						//* put back all into front page
						$.each(data.success.conStaffs,function(key,value){

							if(value.firstname !== undefined && value.lastname !== undefined ){
								$('#allStaffContainer').append('<span  class=\'staffInfo label label-info\'  style=\'color:black;margin:2px;\'>'+value.firstname+', '+value.lastname+'</span>');
							}							
						}); 
					}					
				}
				setTimeout(function(){ $('#resultModal').modal('hide');$('#staffEditor').modal('hide'); },1000);
			}).fail(function(data){

				if(data.responseJSON !== undefined){
					if(data.responseJSON.error !== undefined ){
						var message = data.responseJSON.error.type + ' : '+ data.responseJSON.error.message;
						$('#modalMessage').html(message);
						setTimeout(function(){$('#resultModal').modal('hide');},1500);
					}
				}				
			});
		});

$('#btnSaveReviewPanel').on('click',function(e){ 

	$.ajax({url:'updateReviewPanels'
		,data:{conf_id:{{ $conf->conf_id }},emails:$('#reviewPanel').find('[name=emails]').tagsinput('items')}
		,type:'get'
		,beforeSend:function(){
			$('#modalMessage').html('Loading...');
			$('#resultModal').modal({
				keyboard: false
				,backdrop:'static' });   
		}}).done(function(data){
				//change the current
				if(data.success !== undefined){
					var message = data.success.numRowUpdated +' record(s) updated successfully !!!';
					$('#modalMessage').html(message);
					$('#allReviewPanelContainer').html('');

					if(data.success.conStaffs !== undefined){
						//* put back all into front page
						$.each(data.success.conStaffs,function(key,value){

							if(value.firstname !== undefined && value.lastname !== undefined ){
								$('#allReviewPanelContainer').append('<span  class=\'staffInfo label label-info\'  style=\'color:black;margin:2px;\'>'+value.firstname+', '+value.lastname+'</span>');
							}							
						}); 
					}					
				}
				setTimeout(function(){ $('#resultModal').modal('hide');$('#reviewPanelEditor').modal('hide'); },1000);
			}).fail(function(data){

				if(data.responseJSON !== undefined){
					if(data.responseJSON.error !== undefined ){
						var message = data.responseJSON.error.type + ' : '+ data.responseJSON.error.message;
						$('#modalMessage').html(message);
						setTimeout(function(){$('#resultModal').modal('hide');},1500);
					}
				}				
			});
		});
});

function sendFile(file, editor, weleditable) {
	data = new FormData();
	data.append("image", file);

	$.ajax({ 
		url: "{{ URL::to('utils/registerImageUploadConference') }}",			
		type: "GET",
		data : {conf_id: {{ $conf->conf_id}} },
		success: function(response) {
			if(response.success){
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
						}
					}
				});
			}
		}
	});
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
				<h4 class="pager date">  Chairman : 
					@foreach($confChairUsers as $confChairUser)
					{{  $confChairUser['firstname'] }},  {{ $confChairUser['lastname'] }}
					@endforeach
				</h4>
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
								{{ $conf->description  }}
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
									<td class='col-md-2'>
										<b>Staff :</b>
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
							{{ Form::button('Edit', array('class' => 'btn btn-primary btn-xs pull-right btnEdit','id'=>'btnReviewPanelEdit')) }}
							<br/>
							<table class="table table-striped">
								<tr>
									<td class='col-md-2'>
										<b>Review Panel :</b>
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
						{{ Form::label('lblStaff', 'Staff Email :', array('class' => 'col-md-4 control-label')) }}       
						<div class="col-md-4">
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
<!-- Review Panel -->
<div class="col-md-12 modal fade" id="reviewPanelEditor" tabindex="-1" role="dialog" aria-labelledby="reviewPanelEditor" aria-hidden="true">
	<div class="col-md-12 modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"  id="reviewPanelEditor">Edit Review Panel for : </h4>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class = 'form-horizontal'>
					<div class="form-group">
						{{ Form::label('lblReviewPanel', 'Review Panel Email :', array('class' => 'col-md-4 control-label')) }}       
						<div class="col-md-4">
							<div id="reviewPanel">
								<div class="necessary" id="innerReviewPanel">
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
			{{ Form::button('Save', array('class' => 'btn btn-primary btn-sm','id'=>'btnSaveReviewPanel')) }}
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">			 
				<h4 class="modal-title" id="exampleModalLabel"></h4>
			</div>
			<div class="modal-body">				
				<div class="form-group pager">
					<label class="control-label"><img src="../../img/jqueryui/ajax-loader.gif"></label>
					<label class="control-label" id="modalMessage"></label>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
@stop
