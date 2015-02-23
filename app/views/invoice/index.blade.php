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

<div class="table-responsive">
    <table class="table table-striped">   
        <tr>
            <td style="width:7%"><strong>Invoice #</strong></td>
            <td style="width:20%"><strong>Conference</strong></td>
            <td style="width:8%"><strong>Quantity</strong></td>
            <td style="width:10%"><strong>Total</strong></td>
            <td style="width:15%"><strong>Status</strong></td>
            <td style="width:25%"><strong>Option</strong></td>
        </tr> 
        @foreach ($data as $invoice)
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
        @endforeach
    </table> 
</div>
@stop