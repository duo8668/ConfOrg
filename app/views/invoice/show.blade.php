<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Invoice</title>
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
    <h2>Invoice #{{$invoice->invoice_id}}</h2>
    <div class="row">
      <div class="col-md-8">        
      </div>
      <div class="col-md-4 well">
        <table>
          <tr>
            <td class="pull-right">
              <strong>User</strong>
            </td>
            <td>
              <strong>{{$invoice->user->firstname,',',$invoice->user->lastname}}</strong>
            </td>
          </tr> 
          <tr>
            <td class="pull-right">
              <strong>Email</strong>
            </td>
            <td>
              <strong>{{$invoice->user->email}}</strong>
            </td>
          </tr>
          <tr>
            <td class="pull-right">
              <strong>Purchase Date</strong>
            </td>
            <td>
              <strong>{{$invoice->created_at}}</strong>
            </td>
          </tr>                    
        </table>
      </div>
    </div>  
    <br/>
    <div class="row">
      <div class="col-md-12">
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Conference</th>
            <th>Number of Ticket</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>            
          <tr>
            <td>
             {{$invoice->Conference->title}}
           </td>
           <td>
            {{$invoice->quantity}}
          </td>
          <td>
            ${{$invoice->price}}
          </td>
        </tr>            
        <tr>
          <td>&nbsp;</td>
          <td>
            <strong>Total</strong>
          </td>
          <td>
            <strong>${{$invoice->total}}</strong>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
</div>
</div>
</body>
</html>




