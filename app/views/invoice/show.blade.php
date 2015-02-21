<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Invoice</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.bootstrap.css') }}" rel="stylesheet">
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
  
<div class="invoice">
       <div class="container"> 
        {{ HTML::image('img/logo.png', 'ORAFER', ['class' => 'logo', 'style'=> 'margin-bottom:30px;']) }}
        <div class="row header">

          <div class="col-sm-4">
            <div class="well">
            <h2>From</h2>
            <p><strong>ORAFER</strong></p>
            <p>Email: it144a@gmail.com</p>
            </div>
          </div><!--/col-->

          <div class="col-sm-4">
            <div class="well">
            <h2>To</h2>
            <p><strong>{{{ $invoice->user->firstname}}}  {{{ $invoice->user->lastname }}}</strong></p>
            <p>Email: {{{ $invoice->user->email }}}</p>
            </div>
          </div><!--/col-->

          <div class="col-sm-4">
            <div class="well">
            <h2>Details</h2>
            <p>Invoice <strong>#{{$invoice->invoice_id}}</strong></p>
            <p>Purchased on <strong>{{ date("d F Y",strtotime($invoice->created_at)) }} at {{ date("g:ha",strtotime($invoice->created_at)) }}</strong></p>
            </div>
          </div><!--/col-->   

        </div><!--/row-->
        <table class="table table-striped table-responsive">
          <thead>
            <tr>
              <th class="center">#</th>
              <th>Item</th>
              <th>Description</th>
              <th class="center">Quantity</th>
              <th class="right">Unit Cost</th>
              <th class="right">Total</th>                                          
            </tr>
          </thead>   
          <tbody>
            <tr>
              <td class="center">1</td>
              <td class="left">Entrance Ticket</td>
              <td class="left">{{$invoice->Conference->title}}</td>
              <td class="center">{{$invoice->quantity}}</td>
              <td class="right">${{ $invoice->total / 1}}</td>
              <td class="right">${{$invoice->total}}</td>                                        
            </tr>
           
          </tbody>
        </table>

        <div class="row">

          <div class="col-lg-4 col-sm-5 notice">
            <div class="well">
              Should you discover any disrespancies with the payment invoice, please contact us at it144a@gmail.com.
            </div>  
          </div><!--/col-->

          <div class="col-lg-4 col-lg-offset-4 col-sm-5 col-sm-offset-2 recap">
            <table class="table table-clear">
              <tbody>
                  <td class="left"><strong>Total</strong></td>
                  <td class="right"><strong>${{$invoice->total}}</strong></td>                                        
                </tr>                                  
              </tbody>
            </table>
            <a href="#" class="btn btn-info btn-block" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
          </div><!--/col-->

        </div><!--/row-->
      </div>
      </div><!--/invoice--> 
</body>
</html>




