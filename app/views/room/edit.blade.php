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
    <label class="col-md-4 control-label" for="venue"></label>  
    <div class="col-md-4">                     
      {{ Form::text('searchbox', "search...", array('class' => 'form-control input-md','id'=>'searchbox')) }}        
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="venue">Equipments</label>  
    <div class="col-md-4">                                
      {{Form::select('duallistbox_demo2[]',$equipments,null,array('multiple' => true,'class' => 'form-control','id'=>'duallistbox_demo2','size' =>'5')) }}              
    </div>
  </div>     

  <div class="form-group">      
    <label class="col-md-4 control-label">Quantity</label>  
    <div class="col-md-4">                     
      {{ Form::text('quantity', "1", array('class' => 'form-control input-md','id'=>'quantity')) }}        
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="venue"></label>  
    <div class="col-md-4">                                
      {{ Form::selectRange('number', 1, 100, 1, ['class' => 'field', 'multiple'=>true, 'size' => '5','class' => 'form-control','id'=>'number']) }}      
    </div>
  </div>     
  <!--   <select multiple="1" class="form-control" id="duallistbox_demo2" size="5" name="duallistbox_demo2[]"><option value="1">Audio - Speaker</option><option value="2">Logistics - Chairs</option></select>               -->



  <div class="form-group">
    <label class="col-md-4 control-label" for="submit"></label>
    <div class="col-md-4">                   
      {{ Form::submit('Create Room!', array('name'=>'Create','class' => 'btn btn-primary')) }}      
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
      options.push({value: $(this).val(), text: $(this).text()});
    });
    $(select).data('options', options);
    $(textbox).bind('change keyup', function() {
      var options = $(select).empty().data('options');
      var search = $.trim($(this).val());
      var regex = new RegExp(search,"gi");

      $.each(options, function(i) {
        var option = options[i];
        if(option.text.match(regex) !== null) {
          $(select).append(
           $('<option>').text(option.text).val(option.value)
           );
        }
      });
      if (selectSingleMatch === true && $(select).children().length === 1) {
        $(select).children().get(0).selected = true;
      }
    });            
  });
};


$(function() {
  $('#duallistbox_demo2').filterByText($('#searchbox'), true);
});  

$(function() {
  $('#number').filterByText($('#quantity'), true);
});  

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});

</script>

@stop

