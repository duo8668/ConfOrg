@extends('layouts.dashboard.master')

@section('page-header')
Add New Conference
@stop

<!-- extraScripts Section -->
@section('extraScripts')

<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/icheck/square/green.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/formvalidation/formValidation.css') }}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/lib/moment.min.js') }}"></script>

<script src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}"></script>

<script src="{{ asset('js/icheck/icheck.js') }}"></script>

<script src="{{ asset('js/formvalidation/formValidation.js') }}"></script>

<script src="{{ asset('js/formvalidation/framework/bootstrap.js') }}"></script>

<script src="{{ asset('js/conferencecontroller.js') }}"></script>

<style>

	body {
		/*margin: 40px 10px;*/
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
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

	#frmCreateConf .checkbox label {
		padding-left: 0;
	}

	#frmCreateConf .dateContainer .form-control-feedback {
		top: 0;
		right: -15px;
	}

	#frmCreateConf .venueContainer .form-control-feedback {
		top: 0;
		right: -15px;
	}
</style>

@stop

<!-- Content Section -->
@section('content')
<script>
	
	$(document).ready(function(){

		$('#datetimepickerBegin').datetimepicker({useCurrent: false,pickTime: false	 , pickDate:true});

		$('#datetimepickerEnd').datetimepicker({useCurrent: false, pickTime: false, pickDate:true });
 
		$('#datetimepickerCutOffDate').datetimepicker({useCurrent: false,pickTime: true	 , pickDate:true});
 
		$("#datetimepickerBegin").on("dp.hide",function (e) {
			$('#datetimepickerEnd').data("DateTimePicker").setMinDate(e.date);
			$('#datetimepickerEnd').data("DateTimePicker").setViewDate(e.date);
			$('#datetimepickerCutOffDate').data("DateTimePicker").setMinDate(e.date);
			$('#datetimepickerCutOffDate').data("DateTimePicker").setViewDate(e.date);
		});

		$("#datetimepickerEnd").on("dp.change",function (e) {
			$('#datetimepickerBegin').data("DateTimePicker").setMaxDate(e.date);
		});

		var loadedJson ;
		$('#ddlVenue').hover(function(event){

			var beginDate = $("#datetimepickerBegin").data("DateTimePicker").getDate().format('DD-MM-YYYY');
			var endDate =  $("#datetimepickerEnd").data("DateTimePicker").getDate().format('DD-MM-YYYY');
			if(beginDate != undefined && endDate != undefined){
				$.ajax({
					type: "GET",
					url : "/laravel/public/conference/roomSchedule/availableRooms" ,
					data : {date_start:beginDate,date_end:endDate}
				})
				.done(function(data) {
					var canload = false ;
					if(loadedJson ==undefined){
						canload = true;
					}else{
						canload =(JSON.stringify(loadedJson) != JSON.stringify(data));
					}
					if(canload){
						loadedJson = data;

						$("#ddlVenue").empty();

						$.each(data, function (key, value) {
							$("#ddlVenue").append($("<option></option>").val
								(value.room_id).html(value.room_name));
						});
					}

				})
				.fail(function(xhr,stat,msg) {
					alert(xhr.responseText);
				})
				.always(function(data) {

				});
			}
		});

		$('#frmCreateConf').formValidation({
			err: {
				container: 'tooltip'
			}, 
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				conferenceTitle: {
					validators: {
						notEmpty: {
							message: 'The Conference Title is required'
						},
						stringLength: {
							min: 6,
							max: 30,
							message: 'The Conference Title must be more than 6 and less than 30 characters long'
						},
						regexp: {
							regexp: /^[a-zA-Z0-9 ]+$/,
							message: 'The Conference Title can only consist of alphabetical, number, and space'
						},
						remote: {
							message: 'The Conference Title is not available',
							url: 'validateConference',
							type: 'POST'
						}
					} 
				},
				'chkField[]': {
					validators: {
						choice: {
							min: 2,
							max: 4,
							message: 'Please choose 2 - 4 interest field'
						}
					}
				},
				beginDate: {
					validators: {
						notEmpty: {
							message: 'The Begin Date is required'
						},date: {
							format: 'DD-MM-YYYY',
							message: 'The value is not a valid date'
						}
					} 
				},
				endDate: {
					validators: {
						notEmpty: {
							message: 'The End Date is required'
						},date: {
							format: 'DD-MM-YYYY',
							message: 'The value is not a valid date'
						}
					}
				},
				cutOffDate:{
					validators: {
						date: {
							format: 'DD-MM-YYYY HH:mm',
							message: 'The value is not a valid datetime'
						}
					} 
				},
				minScore:{
					validators: {
						numeric : {
							separator: '.',
							message: 'The value is not a valid numeric'
						}
					}
				},
				maxSeats: {
					validators: {
						notEmpty: {
							message: 'The Max Seats is required'
						},integer: {
							message: 'This value must be integer'
						},greaterThan: {
							inclusive:false,
							value: 0.0 ,
							message: 'This value must be greater than zero'
						}
					}
				},
				venue: {
					validators: {
						notEmpty: {
							message: 'Please select one venue'
						}
					} 
				}
			}
		}).on('err.field.fv err.validator.fv success.validator.fv', function(e, data) {
			if (data.fv.getSubmitButton()) {
				data.fv.disableSubmitButtons(false);
			}
		}).on('success.field.fv', function(e, data) {
			if (data.fv.getSubmitButton()) {
				data.fv.disableSubmitButtons(false);
			}
            //if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            //	data.fv.disableSubmitButtons(true);
            //}
        }).on('success.form.fv', function(e,data) {
            // Prevent form submission         
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');
            $('#resultModal').modal({
            	keyboard: false
            	,backdrop:'static' });   
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                // ... Process the result ...
                var message = '';
                if(result.success != undefined){
                	message += 'Conference created. You may view your conference at ...';
                }else if (result.invalidFields!= undefined){
                	$.each(result.invalidFields,function(key,value){
                		message += '<p>' + key + ':' + value + '</p>';
                	});
                	
                }else{
                	message = 'Unknown error occurred. Please contact System Administrator.'
                }
                $('#modalMessage').html(message);
                setTimeout(function(){
                	if(result.success != undefined){
                		window.location.href ='manage?conf_id=' + result.success.createdConf.conf_id;
                	}else{
                		$('#resultModal').modal('hide');
                	}
                	
                },1000);
            }, 'json')
.fail(function(){

	var message = 'System fatal error, please contact your System Administrator ...';
	$('#resultModal').modal({
		keyboard: false
		,backdrop:'static' }); 

	$('#modalMessage').html(message);
	setTimeout(function(){$('#resultModal').modal('hide');},1000);

}).always(function(){

});

}).find('input[name="chkField[]"]')
            // Init iCheck elements
            .iCheck({
            	checkboxClass: 'icheckbox_square-green'
            })
            // Called when the radios/checkboxes are changed
            .on('ifChanged', function(e) {
                // Get the field name
                var field = $(this).attr('name');
                $('#frmCreateConf').formValidation('revalidateField', field);
            });

        }); 

</script>
<!-- include('../../utils/customcalendar') -->


@if (Auth::check())
<div class="row" id='divFormBody'>
 {{ Form::open(array('url' => 'conference/management/submitCreateConf','method'=>'POST','id'=>'frmCreateConf', 'class' => 'form-horizontal')) }}
	<div class="col-md-12">

		<div class="form-group">
			{{ Form::label('lblConfTitle', 'Title', array('class' => 'col-md-2 control-label')) }}       
			<div class="col-md-10">
				{{ Form::text('conferenceTitle',isset($value)?$value:'',array('name'=>'conferenceTitle','id'=>'conferenceTitle', 'class' => 'form-control necessary'))}}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblConfType', 'Category', array('class' => 'col-md-2 control-label')) }}

			<div class="col-md-10">
				@foreach ($fields as $field)
				<div class="checkbox">
					<label> 
						{{Form::checkbox('chkField[]', 'chkField_'. $field->id,false ,array('id' => 'chkField_'. $field->id ))}}
						{{Form::label('chkField_'. $field->id, $field->label)}}
					</label>
				</div>
				@endforeach
			</div>
		</div> 

		<div class="form-group">
			{{ Form::label('beginDate', 'Begin', array('class' => 'col-md-2 control-label')) }}  
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerBegin">
					{{ Form::text('beginDate',isset($value)?$value:'',array('name'=>'beginDate','id'=>'beginDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('endDate', 'End', array('class' => 'col-md-2 control-label')) }} 
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerEnd">
					{{ Form::text('endDate',isset($value)?$value:'',array('name'=>'endDate','id'=>'endDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('cutOffDate', 'Cut Off', array('class' => 'col-md-2 control-label')) }} 
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerCutOffDate">
					{{ Form::text('cutOffDate',isset($value)?$value:'',array('name'=>'cutOffDate','id'=>'cutOffDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY HH:mm')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('minScore', 'Min. Score', array('class' => 'col-md-2 control-label')) }}       
			<div class="col-md-4">
				{{ Form::text('minScore',isset($value)?$value:'',array('name'=>'minScore','id'=>'minScore', 'class' => 'form-control necessary'))}}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblMaxSeats', 'Max Seats', array('class' => 'col-md-2 control-label')) }}
			<div class="col-md-4">
				{{ Form::text('maxSeats',isset($value)?$value:'',array('name'=>'maxSeats','id'=>'maxSeats','class' => 'form-control',"maxlength"=>"6")) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblVenue', 'Venue', array('class' => 'col-md-2 control-label')) }}
			<div class="col-md-6 venueContainer">
				{{ Form::select('venue',[null=>''],null,array('id'=>'ddlVenue','class' => 'form-control necessary')) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('isFree', 'Is this Conference Free?', array('class' => 'col-md-2 control-label')) }} 
			<div class="col-md-10"> 
				<div class="checkbox">
					{{ Form::checkbox('chkIsFree', 'checked',0,array('name'=>'chkIsFree','id'=>'chkIsFree')) }}    Yes                 
				</div>			
			</div>
		</div>
		<hr>
		<!-- Submit Button -->
		<div class="row">  
	      <div class="col-md-8 col-md-offset-2">
	        {{ Form::submit('Add New Conference', array('class' => 'btn btn-primary btn-md btn-block')) }}

	      </div>
	    </div>   
	{{ Form::close() }}


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
@endif

@stop



