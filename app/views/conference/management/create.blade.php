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

</style>



@stop

<!-- Content Section -->
@section('content')
<script>
	$(document).ajaxStop($.unblockUI); 
	
	
	var eventData;
	$(document).ready(function(){

		$('#dtConference').click(function(){
			var myTitle = $('#conferenceTitle').val();
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
						
					});
				},
				buttons: {
					'Yes': function(){
						$(this).dialog('close');
						callback(eventData);
					},
					'No': function(){
						$(this).dialog('close');
						//callback(eventData);
					}			
				}
			});
		});

$("#frmCreateConf").submit(function(e){
	e.preventDefault();
	var conferenceTitle = $("input#conferenceTitle").val();
	var confType =  $("#confType option:selected").val();
	var beginDate =  $("#beginDate").val();
	var endDate =  $("#endDate").val();
	var isFree =  $("#chkIsFree").is(':checked');
	blockUI();
	$.ajax({
		type: "POST",
		url : "submitCreateConf",
		data : {conferenceTitle:conferenceTitle,confType:confType,beginDate:beginDate,endDate:endDate,isFree:isFree}
	})
	.done(function(data) {
		alert(data);
	})
	.fail(function(xhr,stat,msg) {
		alert(xhr.responseText);
	})
	.always(function(data) {

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



</script>
<!-- include('../../utils/customcalendar') -->

@if (!Auth::Id())
<div id='divFormBody'>
	{{ Form::open(array('url' => 'conference/management/submitCreateConf','method'=>'POST','id'=>'frmCreateConf', 'class' => 'form-horizontal')) }}
    <fieldset>
      
      <div class="form-group">
      	{{ Form::label('lblConfTitle', 'Title', array('class' => 'col-md-4 control-label')) }}       
        <div class="col-md-4">
          {{ Form::text('conferenceTitle',isset($value)?$value:'',array('name'=>'conferenceTitle','id'=>'conferenceTitle', 'class' => 'form-control input-md'))}}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('lblConfType', 'Conference Type', array('class' => 'col-md-4 control-label')) }}
        <div class="col-md-4">
        {{ Form::select('confType',$confTypes,null,array('name'=>'confType','id'=>'confType')) }} </br>
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
@endif

@stop



