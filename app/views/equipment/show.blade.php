@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipment->equipment_name }}@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('equipment.index') }}">Venues</a></li>
  <li class="active">{{{ $equipment->equipment_name }}}</li>
</ol>
<hr>

    <div class="jumbotron text-center">
        <h2>{{ $equipment->equipment_name }}</h2>
        <p>
            <strong>Equipment Name:</strong> {{ $equipment->equipment_name }}<br>
            <strong>Equipment Remarks:</strong> {{ $equipment->equipment_remark }}<br>
            <strong>Category:</strong> {{ $cat }}
        </p>
    </div>
@stop