@section('head-content')    
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
    <link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css">    
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
    <script src="../src/jquery.bootstrap-duallistbox.js"></script>
@stop
@extends('layouts.dashboard.master')
@section('page-header')
Add New Room
@stop
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    
    {{ Form::open(array('url' => 'room', 'class' => 'form-horizontal','id' => 'formCR')) }}
    <fieldset>  

    <div class="form-group @if ($errors->has('venue')) has-error @endif">
      <label class="col-md-4 control-label" for="venue">Venue</label>  
      <div class="col-md-4">        
      {{ Form::select('venue', $venues, null, array('class'=>'form-control input-md')) }}      
      @if ($errors->has('venue')) <p class="help-block">{{ $errors->first('venue') }}</p> 
      @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
      @endif
      </div>
    </div>

    <div class="form-group @if ($errors->has('roomName')) has-error @endif">
      <label class="col-md-4 control-label" for="roomName">Room Name</label>  
      <div class="col-md-4">        
        {{ Form::text('roomName', Input::old('roomName'), array('class' => 'form-control input-md')) }} 
        @if ($errors->has('roomName')) <p class="help-block">{{ $errors->first('roomName') }}</p> @endif        
      </div>    
    </div>

    <div class="form-group  @if ($errors->has('roomCapacity')) has-error @elseif (Session::has('message')) has-error @endif">
      <label class="col-md-4 control-label" for="roomCapacity">Room Capacity</label>
      <div class="col-md-4">                     
        {{ Form::text('roomCapacity', Input::old('roomCapacity'), array('class' => 'form-control input-md')) }}
         @if ($errors->has('roomCapacity')) <p class="help-block">{{ $errors->first('roomCapacity') }}</p> 
         @elseif (Session::has('message')) <p class="help-block">{{ Session::get('message') }}</p> 
         @endif
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="venue">Equipments</label>  
      <div class="col-md-4">              
        {{Form::select('duallistbox_demo2[]',$equipments,Input::old('duallistbox_demo2[]'),['multiple'],array('class' => 'form-control','id'=>'duallistbox_demo2','size' =>'4')) }}              
      </div>
    </div>     

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">                   
      {{ Form::submit('Create Room!', array('name'=>'Create','class' => 'btn btn-primary')) }}      
      </div>
    </div>
    </fieldset>
    {{ Form::close() }} 

    <script>
      var demo2 = $('select[name="duallistbox_demo2[]"]').bootstrapDualListbox();
      $("#formCR").submit(function() {
        
        var venue = $('#venue').val();

        var options = $('#duallistbox_demo2 option:selected');

        var values = $.map(optionsz ,function(option) {
            return option.value;
        }); 
        alert($('select[name="duallistbox_demo2[]"]').val());
          e.preventDefault();
       
            $.ajax({
              type: "POST",
              url : "room",
              data : {selectedvalues:values, name:venue}               
            })
            .done(function(data) {
              alert(data);
            }).fail(function(xhr,stat,msg) {
              alert(xhr.responseText);
           
            }).always(function(data) {

            });
     
      });    
    </script>


    @stop

