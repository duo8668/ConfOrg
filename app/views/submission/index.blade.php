@extends('layouts.dashboard.master')
@section('content')
<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td>Submission ID</td>
			<td>Submission Title</td>
			<td>Submission Type</td>
		</tr> 
		@foreach ($submissions as $sub) 
			<tr>
				<td>{{{ $sub->subId }}}</td>
				<td>{{{ $sub->subTitle }}}</td>
				<td>{{{ $sub->subType }}}</td>
			</tr>
		@endforeach
	</table>
</div>
@stop