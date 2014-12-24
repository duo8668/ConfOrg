@extends('layouts.dashboard.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Select Submission</h2>
  </div>
</div>
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
				<td>{{{ $sub->subId }}}</td>
				<td>{{{ $sub->subTitle }}}</td>
				<td>{{{ $sub->subType }}}</td>
				<td><a href="{{ url('review/create') }}" class="btn btn-info btn-xs">Enter/Edit Review</a></td>
			</tr>
		@endforeach
	</table>
</div>
@stop