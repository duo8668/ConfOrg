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
  	<table class="table table-striped">   
  		<tr>
			<td style="width: 20%;"><strong>Submission Title</strong></td>
			<td style="width: 8%;"><strong>Type</strong></td>
			<td style="width: 30%;"><strong>Conference</strong></td>
			<td style="width: 12%;"><strong>Date Submitted</strong></td>
			<td><strong>Last Updated</strong></td>
			<td style="width: 19%;"><strong>Option</strong></td>
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
				<td>{{ date("d F Y",strtotime($sub->updated_at)) }} at {{ date("g:ha",strtotime($sub->updated_at)) }}</td>
				<td>
					{{ link_to_route('review.show', 'All Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
					@if ($sub->status == 0)
						@if (in_array($sub->sub_id, $reviews)) 
							<?php $key = array_keys($reviews, $sub->sub_id); ?>
							{{ link_to_route('review.edit', 'See Your Review', [$key[0]], ['class' => 'btn btn-success btn-xs'])}}
						@else 
							{{ link_to_route('reviews.add', 'Enter Review', [$sub->sub_id], ['class' => 'btn btn-warning btn-xs'])}}
						@endif
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop