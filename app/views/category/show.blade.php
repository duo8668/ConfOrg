@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $category->Name }}
@stop
@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $category->Name }}</h2>
        <p>
            <strong>Name:</strong> {{ $category->Name }}<br>
            <strong>Remarks:</strong> {{ $category->Remarks }}
        </p>
    </div>
@stop