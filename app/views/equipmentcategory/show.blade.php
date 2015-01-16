@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipmentcategory->equipmentcategory_name }}
@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $equipmentcategory->equipmentcategory_name }}</h2>
        <p>
            <strong>Name:</strong> {{ $equipmentcategory->equipmentcategory_name }}<br>
            <strong>Remarks:</strong> {{ $equipmentcategory->equipmentcategory_remark }}
        </p>
    </div>
@stop