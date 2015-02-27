@extends('layouts.dashboard.master')
@section('page-header')
Invoice & Payment
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Invoice & Payment</li>    
</ol>
<hr>
{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Invoices</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">   
                <thead>
                    <tr class="filters">
                        <th style="width: 7%;"><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Conference" disabled></th>
                        <th style="width: 8%;"><input type="text" class="form-control" placeholder="Quantity" disabled></th>
                        <th style="width: 10%;"><input type="text" class="form-control" placeholder="Total" disabled></th>
                        <th style="width: 15%"><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th style="width: 25%;">Option</th>
                    </tr>
                </thead> 
               
                @foreach ($data as $invoice)
 
                @if(!empty($invoice))

                <tr>            
                    <td>#{{ $invoice->invoice_id }}</td>                        
                    <!-- add a link to the conference -->
                    <td>{{ $invoice->conference->title }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>${{ $invoice->total }}</td>
                    <td>{{ $invoice->status }}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-xs btn-info" href="{{ URL::to('invoice/' . $invoice->invoice_id) }}">Show Invoice</a>
                        @if(!$privilege && $invoice->status!='paid')
                        <a class="btn btn-warning btn-xs" href="{{ URL::to('payment/charges/'.$invoice->invoice_id) }}">Make Payment</a>                
                        @endif
                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        @if($invoice->status=='unpaid')                
                        {{ Form::open(array('url' => 'invoice/' . $invoice->invoice_id, 'class' => 'inline')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Cancel Purchase', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}                
                        @endif
                    </td>
                </tr>
                @endif

                @endforeach
            </table> 
        </div>
    </div>
</div>
@stop