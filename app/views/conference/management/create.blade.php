@extends('layouts.dashboard.master')

@section('page-header')
Add New Conference
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<!-- <link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"> -->

<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/multiselect/bootstrap-dropdown-checkbox.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<!-- <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script> -->

<script src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/jqueryui/jquery.blockUI.js') }}"></script>

<script src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}"></script>

<script src="{{ asset('js/multiselect/bootstrap-dropdown-checkbox.js') }}"></script>

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

	.date {
		background-color: white;
	}

	#frmCreateConf .form-group .col-md-4 .form-control-feedback{
		top: 8px;
		right: 15px;	
	}

	.input-group.date span{
		cursor: pointer; 
	}

	.checkbox{
		margin-left:20px;
	}

</style>



@stop

<!-- Content Section -->
@section('content')
<script>
	//$(document).ajaxStop($.unblockUI); 	
	
	var eventData;



	$(document).ready(function(){

		$('#datetimepickerBegin').datetimepicker({useCurrent: false,pickTime: false	});
		$('#datetimepickerEnd').datetimepicker({useCurrent: false,pickTime: false});

		$("#confType").dropdownCheckbox({
			data: {{$fields}},
			title: "Category",
			showNbSelected:true,
			autosearch:true,
			hideHeader:false,
			templateButton:'<button class="dropdown-checkbox-toggle btn btn-default" data-toggle="dropdown" href="#">Category <span class="dropdown-checkbox-nbselected"></span> <b class="caret"></b> </button>'
		});

		$("#datetimepickerBegin").on("dp.hide",function (e) {

			$('#datetimepickerEnd').data("DateTimePicker").setMinDate(e.date);
		});

		$("#datetimepickerEnd").on("dp.change",function (e) {
               $('#datetimepickerBegin').data("DateTimePicker").setMaxDate(e.date);
            });
		
		$("#datetimepickerBegin").on("dp.show",function (e) {
			$.ajax({
				type: "GET",
				url : "/conference/roomSchedule/unavailabledates"
			})
			.done(function(data) {
				var dates=[];
				var daysOfYear = [];
				for(var i=0;i<data.length;i++){
					dates[i]= { k: moment(data[i].start)};
					for (var d = new Date(data[i].start); d <= new Date(data[i].end); d.setDate(d.getDate() + 1)) {
						daysOfYear.push(new moment(d));
					}
				}
				$('#datetimepickerBegin').data("DateTimePicker").setDisabledDates(daysOfYear);
			})
			.fail(function(xhr,stat,msg) {
				alert(xhr.responseText);
			})
			.always(function(data) {
				$.unblockUI();
			});
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

		//$('#ddlVenue').prop("disabled", true);

		$('#ddlVenue').on('click',function(){
			$.ajax({
				type: "GET",
				url : "/conference/roomSchedule/availableRooms"
			})
			.done(function(data) {
				$("#ddlVenue").empty();

				$.each(data, function (key, value) {
					$("#ddlVenue").append($("<option></option>").val
						(value.room_id).html(value.room_name));
				});
			})
			.fail(function(xhr,stat,msg) {
				alert(xhr.responseText);
			})
			.always(function(data) {
				$.unblockUI();
			});

			
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
				showNbSelected: true,
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
			}, 1500); 	}

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
			{{ Form::label('lblConfType', 'Category', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				<div id="confType" class="dropdown-checkbox dropdown">
					<span class="dropdown-checkbox-nbselected"></span>
				</div>
				
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblConfDesc', 'Conference Description', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				{{ Form::textarea('confDesc',isset($value)?$value:'',array('name'=>'confDesc','id'=>'confDesc','class' => 'form-control','rows'=>3,'cols'=>50)) }} </br>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('beginDate', 'Begin', array('class' => 'col-md-4 control-label')) }}  
			<div class="col-md-4">
				<div class="input-group date" id="datetimepickerBegin">
					{{ Form::text('beginDate',isset($value)?$value:'',array('name'=>'beginDate','id'=>'beginDate','readonly', 'class' => 'form-control', 'data-date-format'=>'YYYY/MMM/DD')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('endDate', 'End', array('class' => 'col-md-4 control-label')) }} 
			<div class="col-md-4">
				<div class="input-group date" id="datetimepickerEnd">
					{{ Form::text('endDate',isset($value)?$value:'',array('name'=>'endDate','id'=>'endDate','readonly', 'class' => 'form-control', 'data-date-format'=>'YYYY/MMM/DD')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblMaxSeats', 'Max Seats', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				{{ Form::text('maxSeats',isset($value)?$value:'',array('name'=>'maxSeats','id'=>'maxSeats','class' => 'form-control',"maxlength"=>"6")) }} </br>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblVenue', 'Venue', array('class' => 'col-md-4 control-label')) }}
			<div class="col-md-4">
				{{ Form::select('venue',[null=>''],null,array('name'=>'ddlVenue','id'=>'ddlVenue','class' => 'form-control')) }} </br>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('isFree', 'Is this Conference Free?', array('class' => 'col-md-4 control-label')) }} 
			<div class="col-sm-5"> 
				<div class="checkbox">
					{{ Form::checkbox('chkIsFree', 'checked',0,array('name'=>'chkIsFree','id'=>'chkIsFree')) }}    Yes                 
				</div>  				
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



