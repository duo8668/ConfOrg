@extends('layouts.dashboard.master')
@section('page-header')
	All Submissions
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
				<td><?php if ($sub->SubType >= 3) {
					echo 'Poster';
				} else if ($sub->subType >= 2) {
					echo 'Full Paper';
				} else {
					echo 'Abstract';
				}?></td>
				<td><a href="{{ url('submission/results') }}" class="btn btn-info btn-xs">Review Results</a></td>
			</tr>
		@endforeach
	</table>
</div>
@stop