<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Laravel 4 E-Commerce</title>
    <style type="text/css">
      body {
        padding     : 25px 0;
        font-family : Helvetica;
      }
      td {
        padding : 0 10px 0 0;
      }
      * {
        float : none;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          
        </div>
        <div class="col-md-4 well">
          <table>
            <tr>
              <td class="pull-right">
                <strong>Account</strong>
              </td>
              <td>
                some random text
              </td>
            </tr>
            <tr>
              <td class="pull-right">
                <strong>Date</strong>
              </td>
              <td>
                some random date
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2>Invoice #44224</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>            
              <tr>
                <td>
                 Yya
                </td>
                <td>
                  wagwa
                </td>
                <td>
                  25
                </td>
              </tr>            
            <tr>
              <td>&nbsp;</td>
              <td>
                <strong>Total</strong>
              </td>
              <td>
                <strong>$ 6.40</strong>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </body>
</html>

   <button class="btn btn-xs btn-info" onclick="$('#{{$value->venue_id}}').toggle();">Show/Hide</button>
                <div id="{{$value->venue_id}}" style="display:none">  
                    Hide show.....
                </div>

                @extends('layouts.dashboard.master')
@section('page-header')
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@stop
@section('content')
<!--<p>Conference Name: {{$conference->title}}</p>
<p>Conference Description: {{$conference->description}}</p>

 'user_id' => string '52' (length=2)
'conf_id' => string '1' (length=1)
'description' => string 'some random text' (length=16)
'TicketPrice' => string '$30' (length=3)
'quantity' => string '2' (length=1)
'days' => string '2' (length=1)
'Total' => string '' (length=0)
'Proceed' => string 'Proceed' (length=7) -->
@extends('layouts.dashboard.master')
@section('page-header')
@section('extraScripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@stop
@section('content')

<p>Conference Name: {{$conference->title}}</p>
<p>Conference Description: {{$conference->description}}</p>

{{Form::open(['id'=>'billing-form', 'class' => 'form-horizontal'])}}
<div class="form-row">
  <label>Ticket Price:</label>{{ Form::text('ticketPrice', $ticketPrice, array('readonly', 'id' => 'ticketPrice')) }}
</div>

<div class="form-row">
  <label>Number of Ticket:</label> {{ Form::selectRange('quantity', 1, 10, null, ['class' => 'field','id'=>'quantity']) }}
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
{{ Form::hidden('conf_id', $conf_id) }}
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
    $('#total').val('$'+$('#ticketPrice').val().replace("$","")*$('#quantity').val());      
  });

  StripeBilling.init();

})();
</script>     
@stop
