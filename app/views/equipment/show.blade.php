@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipment->EquipmentName }}@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $equipment->EquipmentName }}</h2>
        <p>
            <strong>Equipment Name:</strong> {{ $equipment->EquipmentName }}<br>
            <strong>Equipment Remarks:</strong> {{ $equipment->EquipmentRemarks }}<br>
            <strong>Category:</strong> {{ $cat }}
        </p>
    </div>
@stop