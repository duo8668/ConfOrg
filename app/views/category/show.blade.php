@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $category->Name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('category.index') }}">Categories</a></li>
  <li class="active">{{{ $category->Name }}}</li>
</ol>
    <div class="jumbotron text-center">
        <h2>{{ $category->Name }}</h2>
        <p>
            <strong>Name:</strong> {{ $category->Name }}<br>
            <strong>Remarks:</strong> {{ $category->Remarks }}
        </p>
    </div>
@stop