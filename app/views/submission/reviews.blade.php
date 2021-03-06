@extends('layouts.dashboard.master')
@section('page-header')
	Reviews for Submission
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('submission.index') }}">Your Submissions</a></li>
  <li>{{ link_to_route( 'submission.show', $submission->sub_title, ['id' => $submission->sub_id] ) }}</li>
  <li class="active">Submission Reviews</li>
</ol>
<hr>

	@include('reviews._reviewpartials')

@stop