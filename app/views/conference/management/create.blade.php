@extends('layouts.dashboard.master')

@section('page-header')
Add New Conference
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

<script src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/jqueryui/jquery.blockUI.js') }}"></script>

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

	#frmCreateConf .form-group .col-md-4 .form-control-feedback{
		top: 8px;
		right: 15px;	
	}

</style>



@stop

<!-- Content Section -->
@section('content')
<script>
	//$(document).ajaxStop($.unblockUI); 	
	
	var eventData;
	$(document).ready(function(){

		$('#dtConference').on('click',function(){
			var myTitle = $('#conferenceTitle').val();

			if(myTitle.length > 0){
				$('#showCalendar').attr('title','Create Conference for : '+myTitle);

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
						blockUI();
						$.ajax({
							type: "post",
							url: "../../utils/customcalendar",
							data: { 'title': myTitle}
						}).done(function(data) {
							$('#myCalendar').html(data);
						})
						.fail(function(xhr,stat,msg) {
							alert(xhr.responseText);
						})
						.always(function(data) {
							$.unblockUI();
						});
					},
					buttons: {
						'Yes': function(){
							$(this).dialog('close');
							callback(eventData);
						},
						'No': function(){
							$(this).dialog('close');
						}			
					}
				});
			}else{
				alert('Title field cannot be blank !!!');
			}

		});

$('#conferenceTitle').on('change',function(event){

	if($(this).val().trim().length > 6){
		var str = $(this).val();
		if(/^[a-zA-Z0-9- ]*$/.test(str) == false) {
			swapStatus('conferenceTitle','NOTOK','Your title contains illegal characters...');
		}else{
			$.ajax({
				type: "POST",
				url : "checkConfTitle",
				data : {confTitle:$("input#conferenceTitle").val().trim() }
			})
			.done(function(data) {
				if(data != 'true'){				
					swapStatus('conferenceTitle','NOTOK',data);
				}else if(data == 'true'){
					swapStatus('conferenceTitle','OK','');
				}
			})
			.fail(function(xhr,stat,msg) {
				alert(xhr.responseText);
			})
			.always(function(data) {
				$.unblockUI();
			});
		}

	}else{

		swapStatus('conferenceTitle','NOTOK','The length of title must more than 6 !');
	}

});

$("#frmCreateConf").submit(function(e){
	e.preventDefault();
	var conferenceTitle = $("input#conferenceTitle").val().trim();
	var confType =  $("#confType option:selected").val();
	var confDesc =  $("textarea#confDesc").val().trim();
	var beginDate =  $("#beginDate").val();
	var endDate =  $("#endDate").val();
	var isFree =  $("#chkIsFree").is(':checked');

	blockUI();
	$.ajax({
		type: "POST",
		url : "submitCreateConf",
		data : {conferenceTitle:conferenceTitle,confType:confType,confDesc:confDesc,beginDate:beginDate,endDate:endDate,isFree:isFree}
	})
	.done(function(data) {
		if(data.id != undefined){
			// mean it is sucessfully created 
			$.unblockUI();	
			$.blockUI({ 
				message: "<h3><img src='{{ asset('img/jqueryui/check_sign_icon_green.png') }}' /> Your Conference : " + data.Title +" has been created sucessfully ! </h3>"  
			});
			setTimeout(function() { 
				$.unblockUI({ 
					onUnblock: function(){window.location.href='{{ action("ConferenceController@index") }}';}			
				}); 
			}, 1500); 

		}
	}).fail(function(xhr,stat,msg) {
		alert(xhr.responseText);
		$.unblockUI();
	}).always(function(data) {

	});
});
});

function callback(eventData){

	if(eventData != undefined){
		$('#beginDate').val(eventData.start.format('DD-MMM-YYYY'));
		$('#endDate').val(eventData.end.subtract(1,'days').format('DD-MMM-YYYY'));
		eventData.end.add(1,'days');
	}
	$('#myCalendar').html('');
}

function blockUI(){
	$.blockUI({ message: "<h2><img src='{{ asset('img/jqueryui/ajax-loader.gif') }}' /> Just a moment...</h2>" }); 
}

function swapStatus(_id,_status,_msg){
	_class= $('#'+_id).parent();
	$(_class).parent().attr('class','form-group');
	$(_class).find('i').removeClass('fa-asterisk fa-check fa-times');

	if(_status =='OK'){
		$(_class).parent().addClass('has-feedback has-success');
		$(_class).find('i').addClass('fa-check');
	}else if (_status == 'NOTOK'){
		$(_class).parent().addClass('has-feedback has-error');
		$(_class).find('i').addClass('fa-times');
	}else{
		$(_class).find('i').addClass('fa-asterisk');
	}

	$(_class).find('small').text(_msg);
}
</script>
<!-- include('../../utils/customcalendar') -->


@if (Auth::check())
<div id='divFormBody'>
	{{ Form::open(array('url' => 'conference/management/submitCreateConf','method'=>'POST','id'=>'frmCreateConf', 'class' => 'form-horizontal')) }}
	<fieldset>

		<div class="form-group">
			{{ Form::label('lblConfTitle', 'Title', array('class' => 'col-md-4 control-label')) }}       
			<div class="col-md-4">
				{{ Form::text('conferenceTitle',isset($value)?$value:'',array('name'=>'conferenceTitle','id'=>'conferenceTitle', 'class' => 'form-control input-md'))}}
				<i class="form-control-feedback fa-asterisk fa" data-bv-icon-for="name" style="display: block;"></i>
				<small class="help-block" style=""></small>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblConfType', 'Conference Type', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				{{ Form::select('confType',$confTypes,null,array('name'=>'confType','id'=>'confType')) }} </br>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblConfDesc', 'Conference Description', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				{{ Form::textarea('confDesc',isset($value)?$value:'',array('name'=>'confDesc','id'=>'confDesc','rows'=>3,'cols'=>50)) }} </br>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('dtConference', 'Date Range', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">   
				{{ Form::button('Select Date!',array('name'=>'dtConference','id'=>'dtConference')) }} <div id='showCalendar'><div id="myCalendar"></div></div>            
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('beginDate', 'Begin', array('class' => 'col-md-4 control-label')) }}  
			<div class="col-md-4">   
				{{ Form::text('beginDate',isset($value)?$value:'',array('name'=>'beginDate','id'=>'beginDate','readonly', 'class' => 'form-control input-md')) }}                 
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('endDate', 'End', array('class' => 'col-md-4 control-label')) }} 
			<div class="col-md-4">   
				{{ Form::text('endDate',isset($value)?$value:'',array('name'=>'endDate','id'=>'endDate','readonly', 'class' => 'form-control input-md')) }}                 
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('isFree', 'Is this Conference Free?', array('class' => 'col-md-4 control-label')) }} 
			<div class="col-md-4">   
				{{ Form::checkbox('chkIsFree', 'checked',0,array('name'=>'chkIsFree','id'=>'chkIsFree')) }} Yes                 
			</div>
		</div>

		<!-- Submit Button -->
		<div class="form-group">
			<label class="col-md-4 control-label"></label>
			<div class="col-md-4">
				{{ Form::submit('Add New Conference', array('class' => 'btn btn-primary btn-lg')) }}
			</div>
		</div>
	</fieldset>
	{{ Form::close() }}


</div>
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label class="control-label"></label>
						<label class="control-label">Recipient:</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endif

@stop



