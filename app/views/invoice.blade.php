@extends('layouts.dashboard.master')
@section('page-header')
    All Invoice
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
            <td style="width:15%"><strong>User</strong></td>
            <td style="width:15%"><strong>Conference</strong></td>
            <td style="width:15%"><strong>Ticket</strong></td>
            <td style="width:15%"><strong>Total Cost</strong></td>
            <td style="width:15%"><strong>Status</strong></td>
            <td style="width:25%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->user_id}}</td>                        
            <td>{{ $value->description }}</td>
            <td>{{ $value->quantity }}</td>
            <td>{{ $value->total }}</td>
            <td>{{ $value->status }}</td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-xs btn-info" href="{{ URL::to('room/' . $value->room_id . '/edit') }}">Show Invoice</a>
                <a class="btn btn-xs btn-info" href="{{ URL::to('room/' . $value->room_id . '/edit') }}">Make Payment</a>
            </td>
        </tr>
    @endforeach
    </table> 
</div>
@stop