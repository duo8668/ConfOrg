@extends('layouts.dashboard.master')
@section('page-header')
	Select Submissions
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Submissions for Review</li>
</ol>
<hr>

<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td><strong>Submission Title</strong></td>
			<td><strong>Type</strong></td>
			<td><strong>Conference</strong></td>
			<td><strong>Date Submitted</strong></td>
			<td><strong>Option</strong></td>
		</tr> 
		@foreach ($submissions as $sub) 
			<tr>
				<td>{{ link_to_route('review.show', $sub->sub_title, [$sub->sub_id], null)}}</td>
				<td>
					@if ($sub->sub_type === 3)
					    Poster
					@elseif ($sub->sub_type === 2)
					    Full Paper
					@else
					    Abstract
					@endif
				</td>
				<td>{{{ $sub->title }}} </td>
				<td>{{ date("d F Y",strtotime($sub->created_at)) }} at {{ date("g:ha",strtotime($sub->created_at)) }}</td>
				<td>
					{{ link_to_route('review.show', 'See Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
					@if ($sub->review_id == null) 
						{{ link_to_route('reviews.add', 'Enter Review', [$sub->sub_id], ['class' => 'btn btn-warning btn-xs'])}}
					@else 
						{{ link_to_route('review.edit', 'See Your Review', [$sub->review_id], ['class' => 'btn btn-success btn-xs'])}}
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop