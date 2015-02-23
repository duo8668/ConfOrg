@extends('layouts.dashboard.master')
@section('page-header')
Filter Equipments to search for Room
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
</ol>
<hr>
  {{ Form::open()}}
    <legend>Equipment Information</legend>
    <div class="form-group">
        <div class="col-md-6">                     
          <label class="control-label" for="venue">Filter room with equipments</label>  
        </div>
        <div class="col-md-6">                     
          <label class="control-label" for="venue">Room equipment criteria</label>  
        </div>
    </div>

      <div class="form-group">      
        <div class="col-md-6">                     
          {{ Form::text('searchbox', null, array('class' => 'form-control input-md','id'=>'searchbox')) }}        
        </div>
        <div class="col-md-6">                     
          {{ Form::text('searchlist', null, array('class' => 'form-control input-md','id'=>'searchlist')) }}  
        </div>
      </div>

      <div class="form-group">  
        <div class="col-md-6">                                
          {{Form::select('duallistbox_demo2[]',$equipments,null,array('class' => 'form-control','id'=>'duallistbox_demo2','size' =>'5')) }}              
        </div>
        <div class="col-md-6">                                
          <select class="form-control" id="SelectedValues" size="5" name="SelectedValues[]"></select>
        </div>
      </div>     
      <!--   <select multiple="1" class="form-control" id="duallistbox_demo2" size="5" name="duallistbox_demo2[]"><option value="1">Audio - Speaker</option><option value="2">Logistics - Chairs</option></select>               -->
   <hr>
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
  $('#SelectedValues').filterByText($('#searchlist'), true);
           

$("#duallistbox_demo2").change(function(){    
    var equipmentName = $('#duallistbox_demo2 :selected').text();
    var equipmentValue = $("#duallistbox_demo2").val();   
    console.log(equipmentName,equipmentValue);
    $('#duallistbox_demo2 :selected').remove();

    $('#SelectedValues').append($('<option>', {
    value: equipmentValue,
    text: equipmentName
    }));
});

$("#SelectedValues").change(function(){    
    var equipmentName = $('#SelectedValues :selected').text();    
    var equipmentValue = $("#SelectedValues").val();   
    console.log(equipmentName,equipmentValue);
    $('#SelectedValues :selected').remove();

    $('#duallistbox_demo2').append($('<option>', {
    value: equipmentValue,
    text: equipmentName
    }));
});


});
</script>

@stop

