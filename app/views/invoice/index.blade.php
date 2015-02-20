@extends('layouts.dashboard.master')
@section('page-header')
All Invoice - Hello {{$user}}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Invoice</li>    
</ol>
<hr>

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:15%"><strong>Invoice #</strong></td>
            <td style="width:15%"><strong>Conference</strong></td>
            <td style="width:15%"><strong>Number of Ticket</strong></td>
            <td style="width:15%"><strong>Total Cost</strong></td>
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
                @if($invoice->status=='unpaid')
                <a class="btn btn-warning btn-xs" href="{{ URL::to('payment/charges/'.$invoice->invoice_id) }}">Make Payment</a>                
                
                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'invoice/' . $invoice->invoice_id, 'class' => 'inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete Payment', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif
            </td>
        </tr>
        @endforeach
    </table> 
</div>
@stop