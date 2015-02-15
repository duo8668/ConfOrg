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
					{{ link_to_route('submission.reviews', 'Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
					{{ link_to_route('submission.show', 'Edit Submission', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
					{{ Form::model($sub, ['route' => ['submission.destroy', $sub->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
						{{ Form::button('Withdraw', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'])}}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop