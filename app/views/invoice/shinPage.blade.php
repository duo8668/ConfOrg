@extends('layouts.dashboard.master')
@section('page-header')
All Invoice for {{$conference2}}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Category</li>
</ol>
<hr>
<p><strong>Total Number of tickets sold:</strong> {{ $invoice->sum('quantity') }}</p>    
<p><strong>Total Profit:</strong> ${{ $invoice->sum('total') }}</p>    
<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:20%"><strong>User</strong></td>            
            <td style="width:10%"><strong>Number of Tickets</strong></td>
            <td style="width:15%"><strong>Total Cost</strong></td>
            <td style="width:20%"><strong>Payment Date</strong></td>
            <td style="width:30%"><strong>Invoice #</strong></td>
        </tr> 
    @foreach($invoice as $key=>$value)
        <tr>
            <td>{{ $value->user->firstname}} {{ $value->user->lastname}}</td>
            <td>{{ $value->quantity }}</td>
            <td>${{ $value->total }}</td>
            @if(!is_null($value->updated_at))
            <td>{{ $value->updated_at }}</td>
            @else
            <td>{{ $value->created_at }}</td>
            @endif            
            <td>{{ link_to_route('invoice.show', $value->invoice_id, ['id' => $value->invoice_id]) }}</td>
            <!-- we will also add show, edit, and delete buttons -->
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
<a href="{{ URL::route('equipmentcategory.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add New Category</span></a>
@stop