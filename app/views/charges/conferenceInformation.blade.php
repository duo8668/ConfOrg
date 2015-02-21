@extends('layouts.dashboard.master')
@section('page-header')
  Purchase Tickets
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  {{-- <li><a href="{{ URL::to('/invoice') }}">Invoice & Payment</a></li> --}}
  <li class="active">Purchase Tickets</li>    
</ol>
<hr>

  {{ Form::open(array('method'=>'POST','id'=>'billing-ing-form', 'class' => 'form-horizontal')) }}
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
    <label class="col-md-2 control-label"></label>
    <div class="col-md-8">                         
      {{ Form::submit('Proceed', array('name'=>'Proceed','class' => 'btn btn-primary','id' => 'Proceed')) }}
    </div>
  </div>

  {{Form::close()}}  
@stop

