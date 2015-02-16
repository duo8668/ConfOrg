@extends('layouts.dashboard.master')
@section('page-header')
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@stop
@section('content')
  <h1>Make A Payment</h1>

  {{Form::open(['id'=>'billing-form', 'class' => 'form-horizontal'])}}
  	<div class="form-row">
  		<label>
  			<span>Card Number:</span>
  			<input type="text" data-stripe="number">                
  		</label>
  	</div>

  	<div class="form-row">
  		<label>
  			<span>CVC:</span>
  			<input type="text" data-stripe="cvc">
  		</label>
  	</div>

  	<div class="form-row">
  		<label>
  			<span>Expiration Date:</span>
  			{{Form::selectMonth(null, null, ['data-stripe' => 'exp-month'])}}
  			{{Form::selectYear(null,date('Y'), date('Y') + 10, null, ['data-stripe' => 'exp-year'])}}
  		</label>
  	</div>

    <div class="form-row">
      <label>
        <span>Email Address:</span>
        <input type="email" id="email" name="email">
      </label>
    </div>

    <div>
      {{Form::submit('Buy Now')}}
    </div>
    <div class="payment-errors"></div>
  {{Form::close()}}  

  

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

        Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
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

    StripeBilling.init();

})();
  </script>     
@stop
