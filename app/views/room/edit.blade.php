@section('head-content')    
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>  
@stop
@extends('layouts.dashboard.master')
@section('page-header')
Edit {{ $room->room_name }}
@stop
@section('content')

{{ Form::model($room, array('route' => array('room.update', $room->room_id), 'method' => 'PUT', 'class' => 'form-horizontal', 'id'=>'formE')) }}
<fieldset>

  <div id="venue-group" class="form-group" >
    <label class="col-md-4 control-label" for="venue">Venue</label>  
    <div class="col-md-4">        
      {{ Form::select('venue', $venues, $room->venue_id, array('class'=>'form-control input-md')) }}            
    </div>
  </div>

  <div id="roomName-group" class="form-group">
    <label class="col-md-4 control-label" for="roomName">Room Name</label>  
    <div class="col-md-4">                      
      {{ Form::text('roomName', $room->room_name, array('class' => 'form-control input-md')) }}       
    </div>    
  </div>   

 <!--  <div id="name-group" class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Henry Pym">
           
          </div> -->
          <div id="capacity-group" class-"form-group">
            <label class="col-md-4 control-label" for="roomCapacity">Room Capacity</label>
            <div class="col-md-1">                     
              {{ Form::text('roomCapacity', $room->capacity, array('class' => 'form-control input-md')) }}      
            </div>
          </div>

          <div id="cost-group" class="form-group">
            <label class="col-md-1 control-label" for="roomCost">Room Cost</label>
            <div class="col-md-1">                     
              {{ Form::text('roomCost', $room->rental_cost, array('class' => 'form-control input-md')) }}      
            </div>
          </div>

          <div class="form-group">  
            <div class= "row">    
              <label class="col-md-4 control-label"></label>  
              <div class="col-md-2">                     
                <label class="control-label" for="venue">Search Euipment</label>  
              </div>
              <div class="col-md-2">                     
                <label class="control-label" for="venue">Search Quantity (Key only numbers)</label>  
              </div>
            </div>

            <div class="form-group">      
              <label class="col-md-4 control-label"></label>  
              <div class="col-md-2">                     
                {{ Form::text('searchbox', null, array('class' => 'form-control input-md','id'=>'searchbox')) }}        
              </div>
              <div class="col-md-2">                     
                {{ Form::text('quantity', null, array('class' => 'form-control input-md','id'=>'quantity')) }}  
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"></label>  
              <div class="col-md-2">                                
                {{Form::select('duallistbox_demo2[]',$equipments,null,array('class' => 'form-control','id'=>'duallistbox_demo2','size' =>'5')) }}              
              </div>
              <div class="col-md-2">                                
                {{ Form::selectRange('number', 1, 1000, null, ['class' => 'field', 'size' => '5','class' => 'form-control','id'=>'number']) }}      
              </div>
            </div>     
            <!--   <select multiple="1" class="form-control" id="duallistbox_demo2" size="5" name="duallistbox_demo2[]"><option value="1">Audio - Speaker</option><option value="2">Logistics - Chairs</option></select>               -->

            <div class="form-group">
              <label class="col-md-4 control-label"></label>  
              <div class="col-md-4">  
               <button id="btnCombine" class="btn btn-primary" style="margin-bottom:10px;">Combine Value</button>                              
               <button id="btnRemove" class="btn btn-primary" style="margin-bottom:10px;">Remove Value</button>                              
               <button id="btnEdit" class="btn btn-primary" style="margin-bottom:10px;">Edit Value</button>                                                         
             </div>
           </div> 

           <div class="form-group">
            <label class="col-md-4 control-label"></label>  
            <div class="col-md-4">  
             <label class="control-label">Equipments in {{$room->room_name}}</label>  
             {{Form::select('SelectedValues[]',$eqfullname,null,array('class' => 'form-control','id'=>'SelectedValues','size' =>'5')) }}              
           </div>
         </div> 

         <div class="form-group">
          <label class="col-md-4 control-label" for="submit"></label>
          <div class="col-md-4">                   
            {{ Form::submit('Edit Room!', array('name'=>'Create','class' => 'btn btn-primary', 'id'=>'Edit')) }}      
          </div>
        </div>
      </fieldset>
      {{ Form::close() }} 




      <script>
      jQuery.fn.filterByText = function(textbox, selectSingleMatch) {
        return this.each(function() {
          var select = this;
          var options = [];
          $(select).find('option').each(function() {
            options.push({
              value: $(this).val(),
              text: $(this).text()
            }); 
          });
          $(select).data('options', options);
          $(textbox).bind('change keyup', function() {
            var options = $(select).empty().data('options');
            var search = $.trim($(this).val());
            var regex = new RegExp(search, "gi");
            $.each(options, function(i) {
              var option = options[i];
              if (option.text.match(regex) !== null) {
                $(select).append(
                  $('<option>').text(option.text).val(option.value)
                  );
              }
            });
            if (selectSingleMatch === true && $(select).children().length === 1) {
              $(select).children().get(0).selected = true;
            }
          })
        });
      };

      $(function() {
        $('#duallistbox_demo2').filterByText($('#searchbox'), true);
        $('#number').filterByText($('#quantity'), true);
            //called when key is pressed in textbox
            $("#quantity").keypress(function(e) {
              //if the letter is not digit then display error and don't type anything
              if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
              }
            });  

            $("#btnCombine").click(function(e) {
              e.preventDefault();
              var equipmentName = $("#duallistbox_demo2 option:selected").text();
              var number =  $("#number").val();     

              if (!$('#duallistbox_demo2').val()) {
                alert("Please Select An Equipment");
              } 
              else if (!$('#number').val()) {
                alert("Please Select a Quantity");
              } 
              else {
                if ($('#SelectedValues option:contains("' + equipmentName + '")').length) {
                  alert("Equipment Already Selected!");
                }
                else{
                  $("#SelectedValues").append("<option selected>" + $('#duallistbox_demo2 :selected').text() + " - " +number);
                  $('#quantity').val("");
                  $('#quantity').trigger("change");                  
                  $('#searchbox').val("");
                  $('#searchbox').trigger("change");
                }
              }
            }); 

$("#btnRemove").click(function(e) {
  e.preventDefault();
  $("#SelectedValues option:selected").remove();
  $('#duallistbox_demo2 option').attr('selected', false);    
  $('#number option').attr('selected', false);   
});

$("#btnEdit").click(function(e) {
  e.preventDefault();
  var equipmentName = $("#duallistbox_demo2 option:selected").text();
  var number =  $("#number").val();     

  if(!$("#SelectedValues option").length) {    
    alert("There are no avaliable Room Equipments for editing");
  }
  else if(!$('#SelectedValues').val()) {
    alert("Please Select A Room Equipment you want to Edit");
  }
  else {
    if (!$('#duallistbox_demo2').val()) {
      alert("Please Select An Equipment");
    } 
    else if (!$('#number').val()) {
      alert("Please Select a Quantity");
    } 
    else {      
      $("#SelectedValues option:selected").remove();
      $("#SelectedValues").append("<option selected>" + $('#duallistbox_demo2 :selected').text() + " - " +number);
      $('#quantity').val("");
      $('#quantity').trigger("change");                  
      $('#searchbox').val("");
      $('#searchbox').trigger("change");
    }
  }
});

$("#SelectedValues").click(function() {

  var formatted = $('#SelectedValues option:selected').text();  
  var arr = formatted.split(' - ');      
  $('#duallistbox_demo2>option:contains(' + arr[1] + ')').prop('selected', true);
  $('#number').val($.trim(arr[2]));    
});

$('#Edit').click( function() {         

  var values = [];
  var roomName = $('input[name=roomName]').val();          
  var venue = $('select[name=venue]').val();
  var roomCapacity = $('input[name=roomCapacity]').val();
  var token = $('input[name=_token]').val();      
  var roomID = {{$room->room_id}};
  $('#SelectedValues option').each(function() {
    values.push($(this).text());
  });
  var formData = {
   "roomName": $('input[name=roomName]').val(),
   "venue" : $('select[name=venue]').val(),
   "roomCapacity" : $('input[name=roomCapacity]').val(),
   "roomCost" : $('input[name=roomCost]').val(),
   "SelectedValues" : values,
 };               

 $.ajax({      
  type: 'put',
  url: '/laravel/public/room/'+ roomID,
  data : formData,        
  dataType: 'json',

}) 
 .done(function(data) {
              // log data to the console so we can see
              console.log(data);               
              if ( ! data.success) {
            //handle errors for venue
            if (data.errors.venue) {
              $('#venue-group').addClass('has-error'); // add the error class to show red input
              $('#venue-group div.col-md-4').append('<div class="help-block">' + data.errors.venue + '</div>'); // add the actual error message under our input                                                
            }
            // handle errors for roomName 
            if (data.errors.roomName) {
                $('#roomName-group').addClass('has-error'); // add the error class to show red input
                $('#roomName-group div.col-md-4').append('<div class="help-block">' + data.errors.roomName + '</div>'); // add the actual error message under our input                                                
              }
              if (data.errors.roomCapacity) {
              $('#capacity-group').addClass('has-error'); // add the error class to show red input
              $('#capacity-group div.col-md-1').append('<div class="help-block">' + data.errors.roomCapacity + '</div>'); // add the actual error message under our input                                                
            }
            if (data.errors.roomCost) {
                $('#cost-group').addClass('has-error'); // add the error class to show red input
                $('#cost-group div.col-md-1').append('<div class="help-block">' + data.errors.roomCost + '</div>'); // add the actual error message under our input                                                
              }
            }    
            else
            {          
              if( data.success)
               window.location.href = '/laravel/public/room';                    
           }
         });
event.preventDefault();    
});

});
</script>

@stop

