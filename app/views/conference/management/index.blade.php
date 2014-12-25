@extends('layouts.dashboard.master')
@section('content')
 
@foreach($users as $user) 
 {{ $user->website }}
@endforeach
 
@stop
