
@extends('layouts.dashboard.master')
@section('page-header')
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@stop
@section('content')

<?php
    if (!is_null(Session::get('ticketPrice')) && !is_null(Session::get('user')) && !is_null(Session::get('conference'))) {
      $ticketPrice = Session::get('ticketPrice');
      $user = Session::get('user');
      $conference = Session::get('conference');
    }
    else
    {

    }    
?>

<h1>Hello {{$user->firstname, ', ',$user->lastname}}</h1>
<p>Conference Name: {{$conference->title}}</p>
<p>Conference Description: {{$conference->description}}</p>


{{Form::open(['id'=>'billing-form', 'class' => 'form-horizontal'])}}
<div class="form-row">
  Ticket Price: <label id="ticketPrice">{{$ticketPrice}}</label>  
</div>

<div class="form-row">
  <label>Number of Ticket:</label> {{ Form::selectRange('quantity', 0, 10, null, ['class' => 'field','id'=>'quantity']) }}
</div>

<div class="form-row">
  <label>Total Cost:</label> {{ Form::text('total', 0, array('readonly', 'id' => 'total')) }}
</div>

<div class="form-row">
  <label>Email:</label>          
  {{ Form::text('email', $user->email, array('readonly', 'id' => 'email')) }}         
</div>    

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
{{ Form::hidden('conf_id', $conference->conf_id) }}
{{ Form::hidden('user_id', $user->user_id) }}
{{ Form::hidden('description', $conference->description) }}
{{ Form::hidden('price', $ticketPrice) }}

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
