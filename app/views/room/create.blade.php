@extends('layouts.dashboard.master')
@section('page-header')
Add New Room
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('room.index') }}">Room</a></li>
  <li class="active">Add Room</li>
</ol>
<hr>
{{ Form::open(array('url' => 'room', 'method' => 'POST', 'class' => 'form-horizontal','id' => 'formCR')) }}
<fieldset>
<div class="row">
  <div class="col-md-12">
   <legend>Basic Information</legend>
    <div id="venue-group" class="form-group" >
      <label class="col-md-2 control-label" for="venue">Venue</label>  
      <div class="col-md-8">        
        {{ Form::select('venue', $venues, Input::old('venue'), array('class'=>'form-control input-md')) }}            
      </div>
    </div>

    <div id="room_name-group" class="form-group">
      <label class="col-md-2 control-label" for="room_name">Room Name</label>  
      <div class="col-md-8">                            
        {{ Form::text('room_name', Input::old('room_name'), array('class' => 'form-control input-md')) }} 
      </div>    
    </div>   

    <div id="roomCapacity-group" class-"form-group">
      <label class="col-md-2 control-label" for="roomCapacity">Capacity</label>
      <div class="col-md-3">                     
        {{ Form::text('roomCapacity', Input::old('roomCapacity'), array('class' => 'form-control input-md')) }}      
      </div>
    </div>

    <div id="roomCost-group" class="form-group">
      <label class="col-md-2 control-label" for="roomCost">Room Cost</label>
      <div class="col-md-3">                     
        {{ Form::text('roomCost', Input::old('roomCost'), array('class' => 'form-control input-md')) }}      
      </div>
    </div>

    <div style="margin-top:30px;"></div>
    <legend>Equipment Information</legend>
    <div class="form-group">
        <div class="col-md-6">                     
          <label class="control-label" for="venue">Search Euipment</label>  
        </div>
        <div class="col-md-6">                     
          <label class="control-label" for="venue">Search Quantity (Key only numbers)</label>  
        </div>
    </div>

      <div class="form-group">      
        <div class="col-md-6">                     
          {{ Form::text('searchbox', null, array('class' => 'form-control input-md','id'=>'searchbox')) }}        
        </div>
        <div class="col-md-6">                     
          {{ Form::text('quantity', null, array('class' => 'form-control input-md','id'=>'quantity')) }}  
        </div>
      </div>

      <div class="form-group">  
        <div class="col-md-6">                                
          {{Form::select('duallistbox_demo2[]',$equipments,null,array('class' => 'form-control','id'=>'duallistbox_demo2','size' =>'5')) }}              
        </div>
        <div class="col-md-6">                                
          {{ Form::selectRange('number', 1, 1000, null, ['class' => 'field', 'size' => '5','class' => 'form-control','id'=>'number']) }}      
        </div>
      </div>     
      <!--   <select multiple="1" class="form-control" id="duallistbox_demo2" size="5" name="duallistbox_demo2[]"><option value="1">Audio - Speaker</option><option value="2">Logistics - Chairs</option></select>               -->

      <div class="form-group">
        <div class="col-md-6 col-md-offset-3 text-center">  
         <button id="btnCombine" class="btn btn-info btn-sm" style="margin-bottom:10px;">Combine Value</button>                              
         <button id="btnRemove" class="btn btn-info btn-sm" style="margin-bottom:10px;">Remove Value</button>                              
         <button id="btnEdit" class="btn btn-info btn-sm" style="margin-bottom:10px;">Edit Value</button>                                                         
       </div>
     </div> 

     <div class="form-group">
      <div class="col-md-6">  
       <label class="control-label">Room Equipments</label>  
       <select class="form-control" id="SelectedValues" size="5" name="SelectedValues[]"></select>
     </div>
   </div> 

   <hr>
   <div class="row">  
      <div class="col-md-8 col-md-offset-2">
        <!-- Button -->        
        {{ Form::submit('Create Room', array('class' => 'btn btn-primary btn-md btn-block','id'=>'btnThugLife')) }}        
      </div>
    </div>  
   
  </div>
  </fieldset>
  {{ Form::close() }} 
</div>

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

$("#btnThugLife").click(function(e) {
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

$('#btnThugLife').click( function() {         

  var values = [];
  var room_name = $('input[name=room_name]').val();          
  var venue = $('select[name=venue]').val();
  var roomCapacity = $('input[name=roomCapacity]').val();
  var token = $('input[name=_token]').val();      
  $('#SelectedValues option').each(function() {
    values.push($(this).text());
  });
  var formData = {
   "room_name": $('input[name=room_name]').val(),
   "venue" : $('select[name=venue]').val(),
   "roomCapacity" : $('input[name=roomCapacity]').val(),
   "roomCost" : $('input[name=roomCost]').val(),
   "SelectedValues" : values,
 };               

 $.ajax({      
  type: 'POST',
  url: '/laravel/public/room',
  data : formData,        
  dataType: 'json',
  beforeSend: function()
  {
    $('#ajax-loading').show();
    $(".form-group" ).removeClass("has-error");        
    $(".help-block").hide();
  }
})

 .done(function(data) {
              // log data to the console so we can see
              console.log(data);               
              // if ( ! data.success) {
                if (data.validation_failed == 1)
                {
                  var arr = data.errors;
                  $.each(arr, function(index, value)
                  {
                    if (value.length != 0)                      
                    {
                      console.log("#" + index);
                      $('#'+index+'-group').addClass('has-error'); 
                      $("[name="+index+"]").after('<div class="help-block">' + value + '</div>');                                            
                    }
                  });
                  $('#ajax-loading').hide();
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

