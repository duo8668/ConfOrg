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
				<div class="col-md-12">{{{ $rev->internal_comment }}}</div>
			</div>
		@endforeach
	@else 
	  	<br />No comments yet
	@endif
  </div>
</div>
	
@stop
