@extends('layouts.dashboard.master')
@section('page-header')
	Select Submissions
@stop
@section('content')
<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td>Submission ID</td>
			<td>Submission Title</td>
			<td>Submission Type</td>
			<td>Option</td>
		</tr> 
		@foreach ($submissions as $sub) 
			<tr>
				<td>{{{ $sub->Sub_id }}}</td>
				<td>{{{ $sub->SubTitle }}}</td>
				<td>
					@if ($sub->SubType === 3)
					    Poster
					@elseif ($sub->SubType === 2)
					    Full Paper
					@else
					    Abstract
					@endif
				</td>
				<td><a href="{{ url('review/create') }}" class="btn btn-info btn-xs">Enter/Edit Review</a></td>
			</tr>
		@endforeach
	</table>
</div>
@stop