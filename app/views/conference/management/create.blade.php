@extends('layouts.dashboard.master')

@section('page-header')
Add New Conference
@stop

<!-- extraScripts Section -->
@section('extraScripts')
<!--===================================================================================-->
<!--================================     CSS     ======================================-->
<link href="{{ asset('css/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap DatePicker -->
<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap Checbox -->
<link href="{{ asset('css/icheck/square/green.css') }}" rel="stylesheet" type="text/css">
<!-- Bootstrap selectboxit -->
<link href="{{ asset('css/selectboxit/selectboxit.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('css/formvalidation/formvalidation.css') }}" rel="stylesheet" type="text/css">

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

<!-- Bootstrap TypeAhead -->
<script src="{{ asset('js/bootstrap3-typeahead.js') }}"></script>

<!-- STRIPE payment processor  -->
<script src="https://js.stripe.com/v2/"></script>

<script src="{{ asset('js/app/conference/createConference.js') }}"></script>

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

	.resizeTransition{
		transition-property: top;
		transition-duration: 250ms;
	}
</style>

@stop

<!-- Content Section -->
@section('content')
<script type="text/javascript">

	$(document).ready(function () {

		var curDate = new moment(new moment().format('YYYY-MM-DD'));
		loadDateTimePicker(curDate, 15, 30);

		loadFormValidation("{{ URL::to('conference/roomSchedule/availableRooms') }}");

		loadVenueDropDownListAction();

		loadPayNowbutton("{{ URL::to('/payment/actionCreateInvoice') }}");

		var stripeKey = $('meta[name="publishable-key"]').attr('content');
		Stripe.setPublishableKey(stripeKey);

		var StripeBilling = {
			init: function () {
				this.form = $('#billing-form');
				this.submitButton = this.form.find('input[type=submit]');
				this.submitButtonValue = this.submitButton.val();
				var stripeKey = $('meta[name="publishable-key"]').attr('content');
				Stripe.setPublishableKey(stripeKey);
				this.bindEvents();

			},
			bindEvents: function () {
				this.form.on('submit', $.proxy(this.sendToken, this));
			},
			sendToken: function (event) {
				event.preventDefault();
				this.submitButton.val('One Moment...').prop('disabled', true);
				Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
			},
			stripeResponseHandler: function (status, response) {
				if (response.error) {
					this.form.find('.payment-errors').show().text(response.error.message);
					return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
				} else {
                // proceed to create invoice and conference id

            }
            this.form[0].submit();
        }
    };

    $('#cardnumber').on('keyup',function()
    {
    	$(this).val(function(i, v)
    	{
    		var v = v.replace(/[^\d]/g, '').match(/.{1,4}/g);
    		return v ? v.join('-') : '';
    	});
    });

    $('.modal').on('shown.bs.modal',function(e){
    	if($(this).children('div:eq(1)').hasClass('modal-dialog')){
    		$(this).children('div:eq(1)').removeClass('modal-dialog');
    	}
    	var $innerModal = $(this).find('.innerModal');
    	if(!$innerModal.hasClass('resizeTransition')){
    		$innerModal.addClass('resizeTransition');
    	}

    	$innerModal.css('top',($(window).height()-$innerModal.height())/2);
    	$innerModal.css('left',($(window).width()-$innerModal.outerWidth())/2);
    });

    $('.modal').on('show.bs.modal',function(e){
    	var $innerModal = $(this).find('.innerModal');

    	$innerModal.css('top',($(window).height()-$innerModal.height())/2); 
    	$innerModal.css('left',($(window).width()-$innerModal.outerWidth())/2);
    });

    $('.modal').on('hide.bs.modal',function(e){
    	if(!$(this).children('div:eq(1)').hasClass('modal-dialog')){
    		$(this).children('div:eq(1)').addClass('modal-dialog');
    	}
    }); 



});


</script>
<!-- include('../../utils/customcalendar') -->
<!-- BREADCRUMB -->
<ol class="breadcrumb">
	<li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
	<li class="active">Add New Conference</li>
</ol>
<hr>

@if (Auth::check())
<div class="row" id='divFormBody'>
	{{ Form::open(array('url' => URL::to('conference/management/submitCreateConf'),'method'=>'POST','id'=>'frmCreateConf', 'class' => 'form-horizontal')) }}
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('lblConfTitle', 'Conference Title', array('class' => 'col-md-2 control-label')) }}       
			<div class="col-md-10">
				{{ Form::text('conferenceTitle',isset($value)?$value:'',array('name'=>'conferenceTitle','id'=>'conferenceTitle', 'class' => 'form-control necessary'))}}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblConfType', 'Conference Category', array('class' => 'col-md-2 control-label')) }}

			<div class="col-md-10">
				@foreach ($fields as $field)
				<div class="checkbox col-md-4">
					<label> 
						{{Form::checkbox('chkField[]', 'chkField_'. $field->id,false ,array('id' => 'chkField_'. $field->id ))}}
						{{Form::label('chkField_'. $field->id, $field->label)}}
					</label>
				</div>
				@endforeach
				<p class="help-block col-md-12">Categorizing your conference will help in making your conference visible in ORAFER search result</p>
			</div>
		</div> 

		<div class="form-group">
			{{ Form::label('lblCOnfTopic', 'Topics Covered', array('class' => 'col-md-2 control-label')) }}       
			<div class="col-md-10">
				{{ Form::text('conferenceTopic', null ,array('name'=>'conferenceTopic','id'=>'conferenceTopic', 'class' => 'form-control necessary'))}}
				<p class="help-block">Please input each topics separated by comma (,)</p>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('beginDate', 'Start Date', array('class' => 'col-md-2 control-label')) }}  
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerBegin">
					{{ Form::text('beginDate',isset($value)?$value:'',array('name'=>'beginDate','id'=>'beginDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('endDate', 'End Date', array('class' => 'col-md-2 control-label')) }} 
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerEnd">
					{{ Form::text('endDate',isset($value)?$value:'',array('name'=>'endDate','id'=>'endDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>    
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('cutOffDate', 'Peer Review Deadline', array('class' => 'col-md-2 control-label')) }} 
			<div class="col-md-4 dateContainer">
				<div class="input-group date" id="datetimepickerCutOffDate">
					{{ Form::text('cutOffDate',isset($value)?$value:'',array('name'=>'cutOffDate','id'=>'cutOffDate','readonly', 'class' => 'form-control necessary', 'data-date-format'=>'DD-MM-YYYY HH:mm')) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('minScore', 'Minimum Score for Acceptance', array('class' => 'col-md-2 control-label')) }}       
			<div class="col-md-4">
				{{ Form::text('minScore',isset($value)?$value:'',array('name'=>'minScore','id'=>'minScore', 'class' => 'form-control necessary'))}}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lblMaxSeats', 'Total Seats', array('class' => 'col-md-2 control-label')) }}
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
		<hr>
		<!-- Submit Button -->
		<div class="row">  
			<div class="col-md-8 col-md-offset-2">
				{{ Form::submit('Add New Conference', array('class' => 'btn btn-primary btn-md btn-block')) }}

			</div>
		</div>   
		{{ Form::close() }}
	</div>

	<!-- Payment Panel -->
	<div class="col-md-12 modal fade" id="paymentPanel" tabindex="-1" role="dialog" aria-labelledby="paymentPanel" aria-hidden="true">
		<div class="innerModal col-md-8 modal-dialog">
			<div class="col-md-12 modal-content">
				{{ Form::open(array('url' => URL::to('payment/actionCreatePayment'),'method'=>'POST','id'=>'billing-form', 'class' => 'form-horizontal')) }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"  id="lblPaymentPanel">Please enter your payment details: </h4>
					<div class="payment-errors"></div>
				</div>
				<div class="modal-body" id="paymentPanelFields">
					<fieldset>

						<div class = 'form-horizontal'>
							<div class="form-group">
								{{ Form::label('lblPrice', 'Price :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4">
									<div class="input-group" id="innerPrice">
										{{ Form::text('price',isset($value)?$value:'',array('id'=>'price', 'class' => 'form-control necessary','readonly','maxlength' => '10')) }}  
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblQuantity', 'Quantity :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4">
									<div class="input-group" id="innerQuantity">
										{{ Form::text('quantity',isset($value)?$value:'',array('id'=>'quantity', 'class' => 'form-control necessary','readonly','maxlength' => '5')) }}  
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblTotal', 'Total :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4">
									<div class="input-group" id="innerTotal">
										{{ Form::text('total',isset($value)?$value:'',array('id'=>'total', 'class' => 'form-control necessary','readonly','maxlength' => '5')) }}  
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblCreditCardNumber', 'Credit Card Number :', array('class' => 'col-md-4 control-label')) }}
								<div class="col-md-4">
									<div class="input-group" id="innerCreditCardNumber">
										{{ Form::text('cardnumber',isset($value)?$value:'',array('id'=>'cardnumber', 'class' => 'form-control necessary','maxlength' => '20', 'data-stripe'=>'number')) }}  
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblCVC', 'CVC :', array('class' => 'col-md-4 control-label')) }}       
								<div class="col-md-4">
									<div class="necessary" id="innerCVC">
										{{ Form::text('cvc',isset($value)?$value:'',array('id'=>'cvc', 'class' => 'form-control necessary', 'data-stripe'=>'cvc','maxlength' => '3')) }}
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lblExpirationDate', 'Card Expiry :', array('class' => 'col-md-4 control-label')) }}       
								<div class="col-md-4">
									<div class="necessary" id="innerExpiry">
										{{Form::selectMonth(null, null, array('class' => 'form-control necessary','data-stripe' => 'exp-month'))}}
										{{Form::selectYear(null,date('Y'), date('Y') + 10, null,  array('class' => 'form-control necessary','data-stripe' => 'exp-year'))}}
									</div>
								</div>
							</div>
							<div class="row">  
								<div class="col-md-3 col-md-offset-2">
									<!-- Button -->     
									{{ Form::submit('Pay Now !!!', array('id'=>'btnPayNow','class' => 'btn btn-primary btn-md btn-block')) }}
								</div>
							</div>   
						</div>						

					</fieldset>	
				</div>
				<div class="modal-footer">
				</div>
				{{ Form::close() }}
			</div>
		</div>

	</div>

	<!-- Return Message -->
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



