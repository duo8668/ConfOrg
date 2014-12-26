@extends('layouts.dashboard.master')
@section('content')
<h1>Showing {{ $equipment->EquipmentName }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $equipment->EquipmentName }}</h2>
        <p>
            <strong>Equipment Name:</strong> {{ $equipment->EquipmentName }}<br>
            <strong>Equipment Remarks:</strong> {{ $equipment->EquipmentRemarks }}<br>
            <strong>Category:</strong> {{ $cat }}
        </p>
    </div>
@stop