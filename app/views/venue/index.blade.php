@extends('layouts.dashboard.master')
@section('page-header')
    All Venues
@stop
@section('content')
 <!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Venues</li>
</ol>
<hr>

    @include('venue._indexpartials')

@stop