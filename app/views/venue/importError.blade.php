@extends('layouts.dashboard.master')
@section('page-header')
{{$numError}} Error Discovered!
@stop
@section('content')
@if (Session::has('message'))
<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Sheet Name</td>
            <td>Row Number</td>
            <td>Column</td>                        
            <td>Error Message</td>
        </tr>
    </thead>
    <tbody>

        @foreach($allError as $key => $value)
        <tr>            

            <td>{{ $value["Sheet"] }}</td> 
            <td>{{ $value["Row"] }}</td> 
            <td>{{ $value["column"] }}</td>             
            <td>{{ $value["error"] }}</td>           
            <!-- we will also add show, edit, and delete buttons -->      
        </tr>
    </tbody>  
    @endforeach
@stop