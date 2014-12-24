@extends('layouts.dashboard.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">All Submissions</h2>
  </div>
</div>
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