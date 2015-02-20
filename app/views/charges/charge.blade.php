
@extends('layouts.dashboard.master')
@section('page-header')
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@stop
@section('content')

<h2>Hello {{$invoice->user->firstname,',',$invoice->user->lastname}} </h2>
<h2>Conference: {{$invoice->Conference->title}}</h2>

{{Form::open(['id'=>'billing-form', 'class' => 'form-horizontal'])}}
<div class="form-row">
  Ticket Price per ticket: <label id="ticketPrice">$30</label>  
</div>

<div class="form-row">
  <label>Number of Ticket:</label> {{ Form::selectRange('quantity', 0, 10, null, ['class' => 'field','id'=>'quantity']) }}
</div>

<div class="form-row">
  <label>Total Cost:</label> {{ Form::text('total', 0, array('readonly', 'id' => 'total')) }}
</div>

<div class="form-row">
  <label>Email:</label>          
  <!---need to submit this to the controller---->
  {{ Form::text('email', $invoice->user->email, array('readonly', 'id' => 'email')) }}         
</div>    


<h2>Fill in your credit card details here:</h2>
<div class="form-row">
  <label>
    <span>Card Number:</span>
    <input type="text" data-stripe="number" value="4000000000000002">                
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

  $("#quantity").change(function() {  
    var ticket = $('#ticketPrice').text().replace("$","");
    var quantity = $('#quantity').val();
    $('#total').val('$'+ticket*quantity);      
  });

  StripeBilling.init();

})();
</script>     
@stop
