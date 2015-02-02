@extends('layouts.dashboard.master')
@section('page-header')
	Your Submissions
@stop
@section('content')
<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td>Submission Title</td>
			<td>Type</td>
			<td>Date Submitted</td>
			<td>Option</td>
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
				<td>{{ date("d F Y",strtotime($sub->created_at)) }} at {{ date("g:ha",strtotime($sub->created_at)) }}</td>
				<td>
					{{ link_to_route('submission.reviews', 'Reviews', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
					{{ link_to_route('submission.show', 'View/Edit', [$sub->sub_id], ['class' => 'btn btn-success btn-xs'])}}
					{{ Form::model($sub, ['route' => ['submission.destroy', $sub->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
						{{ Form::button('Withdraw', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'])}}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop