@extends('layouts.dashboard.master')
@section('page-header')
	Your Submissions
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Your Submissions</li>
</ol>
<hr>

<div class="table-responsive">
  	<table class="table table-striped">   
  		<tr>
			<td style="width: 20%;"><strong>Submission Title</strong></td>
			<td style="width: 8%;"><strong>Type</strong></td>
			<td style="width: 30%;"><strong>Conference</strong></td>
			<td style="width: 12%;"><strong>Date Submitted</strong></td>
			<td><strong>Status</strong></td>
			<td style="width: 25%;"><strong>Option</strong></td>
		</tr> 
		@foreach ($submissions as $sub) 
			<tr class="@if ($sub->status === 1) success @elseif ($sub->status === 9) danger @endif">
				<td>{{ link_to_route('submission.show', $sub->sub_title, [$sub->sub_id], null)}}</td>
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
					@if ($sub->status === 1)
					    <span class="text-success"><strong>Accepted</strong></span>
					@elseif ($sub->status === 9)
					    <span class="text-danger"><strong>Rejected</strong></span>
					@else
					    On review
					@endif
				</td>
				<td>
					{{ link_to_route('submission.reviews', 'Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
					{{ link_to_route('submission.show', 'View/Edit Submission', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
					@if ($sub->status === 0)
						{{ Form::model($sub, ['route' => ['submission.destroy', $sub->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
							{{ Form::button('Withdraw', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'])}}
						{{ Form::close() }}
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop