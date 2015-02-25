@extends('layouts.dashboard.master')
@section('page-header')
	Reviews for Submission
@stop
@section('content')
<!-- BREADCRUMB -->
@if (Auth::user()->hasConfRole($submission->conf_id, 'Conference Chair'))
	<ol class="breadcrumb">
	  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
	  <li><a href="{{ URL::to('/conference/detail?conf_id=' . $submission->conf_id) }}">Conference Detail</a></li>
	  <li class="active">Submission Reviews</li>
	</ol>
	<hr>
@else
	<ol class="breadcrumb">
	  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
	  <li><a href="{{ URL::route('review.index') }}">Reviews</a></li>
	  <li class="active">Submission Reviews</li>
	</ol>
	<hr>
@endif

	@include('reviews._reviewpartials')
<?php
	$count = count($reviews);
?>
<div style="margin-bottom:40px"></div>
<div class="row">
  <div class="col-md-12"><strong>Internal comments from other reviewers</strong>
  	@if ($count > 0)
		@foreach ($reviews as $rev)
			<hr>
			<div class="row">
				<div class="col-md-12"><p><strong>{{{ $rev->firstname }}} {{{ $rev->lastname }}} commented:</strong></p> {{{ $rev->internal_comment }}}</div>
			</div>
		@endforeach
	@else 
	  	<br />No comments yet
	@endif
  </div>
</div>
	
@stop
