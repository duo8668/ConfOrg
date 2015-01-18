@section('head-content')    
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
<link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css">    
<script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
<script src="../src/jquery.bootstrap-duallistbox.js"></script>
@stop
@extends('layouts.dashboard.master')
@section('page-header')
Edit {{ $room->room_name }}
@stop
@section('content')
{{ Form::model($room, array('route' => array('room.update', $room->room_id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
<fieldset>
  <div class="form-group @if ($errors->has('venue')) has-error @endif">
    <label class="col-md-4 control-label" for="venue">Venue</label>  
    <div class="col-md-4">        
      {{ Form::select('venue', $venues, $room->venue_id, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('venue')) <p class="help-block">{{ $errors->first('venue') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
    </div>
  </div>

  <div class="form-group @if ($errors->has('roomName')) has-error @endif">
    <label class="col-md-4 control-label" for="roomName">Room Name</label>  
    <div class="col-md-4">                      
      {{ Form::text('roomName', $room->room_name, array('class' => 'form-control input-md')) }} 
      @if ($errors->has('roomName')) <p class="help-block">{{ $errors->first('roomName') }}</p> @endif        
    </div>    
  </div>

  <div class="form-group  @if ($errors->has('roomCapacity')) has-error @endif">
    <label class="col-md-4 control-label" for="roomCapacity">Room Capacity</label>
    <div class="col-md-4">                     
      {{ Form::text('roomCapacity', $room->capacity, array('class' => 'form-control input-md')) }}
      @if ($errors->has('roomCapacity')) <p class="help-block">{{ $errors->first('roomRemarks') }}</p> @endif
    </div>
  </div>

  <div class="form-group">  
    <div class= "row">    
      <label class="col-md-4 control-label"></label>  
      <div class="col-md-2">                     
        <label class="control-label" for="venue">Search Euipment</label>  
      </div>
      <div class="col-md-2">                     
        <label class="control-label" for="venue">Search Quantity</label>  
      </div>
    </div>



    <div class="form-group">      
      <label class="col-md-4 control-label"></label>  
      <div class="col-md-2">                     
        {{ Form::text('searchbox', null, array('class' => 'form-control input-md','id'=>'searchbox')) }}        
      </div>
      <div class="col-md-2">                     
        {{ Form::text('quantity', 1, array('class' => 'form-control input-md','id'=>'quantity')) }}  
      </div>

    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="venue"></label>  
      <div class="col-md-2">                                
        {{Form::select('duallistbox_demo2[]',$equipments,null,array('class' => 'form-control','id'=>'duallistbox_demo2','size' =>'5')) }}              
      </div>
      <div class="col-md-2">                                
        {{ Form::selectRange('number', 1, 10, 1, ['class' => 'field', 'size' => '5','class' => 'form-control','id'=>'number']) }}      
      </div>
    </div>     
    <!--   <select multiple="1" class="form-control" id="duallistbox_demo2" size="5" name="duallistbox_demo2[]"><option value="1">Audio - Speaker</option><option value="2">Logistics - Chairs</option></select>               -->



    <div class="form-group">
      <label class="col-md-4 control-label" for="venue"></label>  
      <div class="col-md-4">  
       <button id="btnCombine" class="btn btn-primary" style="margin-bottom:10px;">Combine Value</button>                              
       <button id="btnRemove" class="btn btn-primary" style="margin-bottom:10px;">Remove Value</button>                              
       <button id="btnEdit" class="btn btn-primary" style="margin-bottom:10px;">Edit Value</button>                              
       <select id="SelectedValues" name="SelectedValues[]" class="form-control" size="5"></select> 
     </div>
   </div> 

   <div class="form-group">
    <label class="col-md-4 control-label" for="submit"></label>
    <div class="col-md-4">                   
      {{ Form::submit('Edit Room!', array('name'=>'Create','class' => 'btn btn-primary')) }}      
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
        $('#searchbox').val("");
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
      $('#searchbox').val("");      
    }
  });

  $("#SelectedValues").click(function() {

    var formatted = $('#SelectedValues').val();
    var arr = formatted.split(' - ');    

    $('#duallistbox_demo2>option:contains(' + arr[0] + ')').prop('selected', true);
    $('#number').val(arr[1]);    

  });
});

</script>

@stop

