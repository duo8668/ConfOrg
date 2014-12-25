@extends('layouts.dashboard.master')
@section('page-header')
	Select Submissions
@stop
@section('content')
<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td>Review ID</td>
			<td>Submission Title</td>
			<td>Submission Type</td>
			<td>Option</td>
		</tr> 
		@foreach ($submissions as $sub) 
			<tr>
				<td>{{{ $sub->Sub_id }}}</td>
				<td>{{{ $sub->SubTitle }}}</td>
				<td><?php if ($sub->SubType >= 3) {
					echo 'Poster';
				} else if ($sub->subType >= 2) {
					echo 'Full Paper';
				} else {
					echo 'Abstract';
				}?></td>
				<td><a href="{{ url('review/create') }}" class="btn btn-info btn-xs">Enter/Edit Review</a></td>
			</tr>
		@endforeach
	</table>
</div>
@stop