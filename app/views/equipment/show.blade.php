@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipment->equipment_name }}@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $equipment->equipment_name }}</h2>
        <p>
            <strong>Equipment Name:</strong> {{ $equipment->equipment_name }}<br>
            <strong>Equipment Remarks:</strong> {{ $equipment->equipment_remark }}<br>
            <strong>Category:</strong> {{ $cat }}
        </p>
    </div>
@stop