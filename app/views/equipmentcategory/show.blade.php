@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $category->category_name }}
@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $category->category_name }}</h2>
        <p>
            <strong>Name:</strong> {{ $category->category_name }}<br>
            <strong>Remarks:</strong> {{ $category->category_remark }}
        </p>
    </div>
@stop