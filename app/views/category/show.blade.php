@extends('layouts.dashboard.master')
@section('content')
<h1>Showing {{ $category->Name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $category->Name }}</h2>
        <p>
            <strong>Name:</strong> {{ $category->Name }}<br>
            <strong>Remarks:</strong> {{ $category->Remarks }}
        </p>
    </div>
@stop