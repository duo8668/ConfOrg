          @extends('layouts.dashboard.master')
          @section('page-header')

          @section('content')
          <h1>Conference Information</h1>          
          {{ Form::open(array('action' => 'BillController@paymentCharges','method'=>'POST','id'=>'billing-infor-form', 'class' => 'form-horizontal')) }}
          <div class="form-group">
            <label class="col-md-2 control-label">User ID:</label>  
            <div class="col-md-8">        
              {{ Form::text('user_id', $userID, array('class' => 'form-control input-md')) }}         
            </div>    
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label">Conference ID:</label>  
            <div class="col-md-8">        
              {{ Form::text('conf_id', 1, array('class' => 'form-control input-md')) }}         
            </div>    
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label">Description:</label>  
            <div class="col-md-8">        
              {{ Form::text('description', 'some random text', array('class' => 'form-control input-md')) }}         
            </div>    
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label">Price Per Ticket:</label>  
            <div class="col-md-8">        
              {{ Form::text('TicketPrice', '$30', array('class' => 'form-control input-md', 'id'=>'TicketPrice')) }}         
            </div>    
          </div>

          <div class="form-group" >
            <label class="col-md-2 control-label">Number of ticket</label>  
            <div class="col-md-8">        
              {{ Form::selectRange('quantity', 1, 10, 2, ['class' => 'form-control input-md','id'=>'quantity']) }}    
            </div>
          </div>

          <div class="form-group" >
            <label class="col-md-2 control-label">Number of days</label>  
            <div class="col-md-8">        
              {{ Form::selectRange('days', 1, 4, 2, ['class' => 'form-control input-md','id'=>'days']) }}    
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label">Total Amount:</label>  
            <div class="col-md-8">        
              {{ Form::text('Total', null, array('class' => 'form-control input-md','id' => 'Total')) }}         
            </div>    
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-8">           
              {{ Form::submit('Calculate', array('name'=>'Calculate','class' => 'btn btn-primary','id' => 'Calculate')) }}
              {{ Form::submit('Proceed', array('name'=>'Proceed','class' => 'btn btn-primary','id' => 'Proceed')) }}
            </div>
          </div>

          {{Form::close()}}  
          <script>
            $(function() {
             $("#Calculate").click(function(e) {
              
              e.preventDefault();

              var quantity = $('#quantity').val();
              var days = $('#days').val();
              var TicketPrice = $('#TicketPrice').val();                          
              console.log(quantity,days,TicketPrice);
              
              //var math = quantity*days;
              var price = TicketPrice.replace("$", "");
              var math = parseInt(price)*days*quantity;
              $('#Total').val(math);                            
            });
          });

          </script>     
          @stop

