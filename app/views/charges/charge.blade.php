
@extends('layouts.dashboard.master')
@section('page-header')
  Make Payment
@stop
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::to('/invoice') }}">Invoice & Payment</a></li>
  <li class="active">Make Payment</li>    
</ol>
<hr>

<div class="row">
  {{ Form::open(['id'=>'billing-form', 'class' => 'form-horizontal']) }}
   <div class="col-md-12">
        
        <legend>Ticket Details</legend>
        <!-- Conference Name -->
        <div class="form-group">
          <label class="col-md-2 control-label">Conference</label>
          <div class="col-md-10">
            <p class="form-control-static"><strong>{{$invoice->Conference->title}}</strong></p>
          </div>
        </div>
        
        <div class="form-group @if ($errors->has('sub_type')) has-error @endif">
          <label class="col-md-2 control-label">Ticket Price</label>
          <div class="col-md-10">
            <p class="form-control-static" id="ticketPrice"><strong>{{$invoice->price}}</strong></p>
          </div>
        </div>
       
       <div class="form-group @if ($errors->has('quantity')) has-error @endif">
          {{ Form::label('quantity', 'Ticket Quantity', ['class' => 'col-md-2 control-label']) }} 
          <div class="col-md-2">
            {{ Form::selectRange('quantity', 0, 10, null, ['class' => 'form-control','id'=>'quantity']) }}
            @if ($errors->has('quantity')) <p class="help-block">{{ $errors->first('quantity') }}</p> @endif
          </div>
        </div>
        <div class="clearfix"></div>

         <div class="form-group @if ($errors->has('total')) has-error @endif">
          {{ Form::label('total', 'Total Price', ['class' => 'col-md-2 control-label']) }} 
          <div class="col-md-2">
            {{ Form::text('total', 0, array('readonly', 'id' => 'total', 'class' => 'form-control')) }}
            @if ($errors->has('total')) <p class="help-block">{{ $errors->first('total') }}</p> @endif
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('email')) has-error @endif">
          {{ Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) }} 
          <div class="col-md-6">
            {{ Form::text('email', $invoice->user->email, array('readonly', 'id' => 'email', 'class' => 'form-control')) }} 
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
          </div>
        </div>
        <div class="clearfix"></div>
        <div style="margin-bottom:30px;"></div>

        <legend>Credit Card Details</legend>

        <div class="payment-errors"></div>

        <div class="form-group @if ($errors->has('email')) has-error @endif">
          <label class="col-md-2 control-label">Card Number</label>
          <div class="col-md-6">
               <input type="text" data-stripe="number" value="4000000000000002" class="form-control" id="card-number"> 
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('email')) has-error @endif">
          <label class="col-md-2 control-label">CVC Number</label>
          <div class="col-md-6">
            <input type="text" data-stripe="cvc" class="form-control" id = "card-cvc">
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('email')) has-error @endif">
          <label class="col-md-2 control-label">Expiration Date</label>
          <div class="col-md-6">
              <div class="col-md-3" style="padding-left: 0;">  
                  {{Form::selectMonth(null, null, ['data-stripe' => 'exp-month', 'class' => 'form-control', 'id' => 'card-expiry-month'])}}
              </div>
              <div class="col-md-3" style="padding-left: 0;">  
                  {{Form::selectYear(null,date('Y'), date('Y') + 10, null, ['data-stripe' => 'exp-year', 'class' => 'form-control', 'id' => 'card-expiry-year'])}}
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div>

    <div class="row">  
      <div class="col-md-8 col-md-offset-2">
        <!-- Button -->     
        {{ Form::submit('Buy Now', array('class' => 'btn btn-primary btn-md btn-block')) }}

      </div>
    </div>    
    {{ Form::close() }}
</div>



<script>
(function(){
  var StripeBilling ={
    init:function(){
      this.form = $('#billing-form');
      this.submitButton = this.form.find('input[type=submit]');
      this.submitButtonValue = this.submitButton.val();
      var stripeKey = $('meta[name="publishable-key"]').attr('content');
      Stripe.setPublishableKey(stripeKey);

      this.bindEvents();

    },

    bindEvents:function() {
      this.form.on('submit', $.proxy(this.sendToken, this));
    },

    sendToken: function(event){ 
      this.submitButton.val('One Moment').prop('disabled', true);

      Stripe.card.createToken({
		    number: $('#card-number').val(),
  cvc: $('#card-cvc').val(),
  exp_month: $('#card-expiry-month').val(),
  exp_year: $('#card-expiry-year').val()
	  }, $.proxy(this.stripeResponseHandler, this));
      event.preventDefault();
    },

    stripeResponseHandler: function(status,response) {        
      if(response.error){
        this.form.find('.payment-errors').show().text(response.error.message);
        return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
      }

      $('<input>', {
        type:'hidden',
        name: 'stripe-token',
        value: response.id
      }).appendTo(this.form);

      this.form[0].submit();
    }

  };

  $("#quantity").change(function() {  
    var ticket = $('#ticketPrice').text().replace("$","");
    var quantity = $('#quantity').val();    
    $('#total').val('$'+ticket*quantity);      
  });

  StripeBilling.init();

})();
</script>     
@stop
