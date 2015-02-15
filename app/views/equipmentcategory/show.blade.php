@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $equipmentcategory->equipmentcategory_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('equipmentcategory.index') }}">Category</a></li>
  <li class="active">{{{ $equipmentcategory->equipmentcategory_name }}}</li>
</ol>
<hr>
    <div class="jumbotron text-center">
        <h2>{{ $equipmentcategory->equipmentcategory_name }}</h2>
        <p>
            <strong>Name:</strong> {{ $equipmentcategory->equipmentcategory_name }}<br>
            <strong>Remarks:</strong> {{ $equipmentcategory->equipmentcategory_remark }}
        </p>
    </div>
@stop