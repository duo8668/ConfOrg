@extends('layouts.dashboard.master')
@section('page-header')
	Reviews for Submission
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('review.index') }}">Reviews</a></li>
  <li class="active">Submission Reviews</li>
</ol>
<hr>

	@include('reviews._reviewpartials')
	
@stop
