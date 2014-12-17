@extends('layouts.dashboard.master')

@section('page-header')
Hello world
@stop

@section('content')

@if (!Auth::Id())
@include("conference.management.participant")
@endif

@if (Auth::Id())
@include("conference.management.reviewpanel")
@endif
 

@stop
