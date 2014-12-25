@extends('layouts.dashboard.master')
@section('page-header')
	Review Results for Current Submission
@stop
@section('content')
<div class="row">
  <div class="col-md-2"><strong>Submission Title</strong></div>
  <div class="col-md-10">How I Met Your mother</div>
</div>
<div class="row">
  <div class="col-md-2"><strong>Submission Type</strong></div>
  <div class="col-md-10">Abstract</div>
</div>
<hr>
	<div class="table-responsive">
	  <table class="table">
	    <tr class="active text-center">
			<td>Quality</td>
			<td>Originality</td>
			<td>Relevance</td>
			<td>Significance</td>
			<td>Presentation</td>
			<td><strong>Overall Recommendation</strong></td>
		</tr>
		<tr class="success text-center">
			<td>5</td>
			<td>5</td>
			<td>5</td>
			<td>5</td>
			<td>5</td>
			<td><strong>5</strong></td>
		</tr>
	  </table>
	</div>
<div class="row">
  <div class="col-md-2"><strong>Comments</strong></div>
  <div class="col-md-10">It is a well-written paper. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
</div>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10"><hr>Not bad, need more work on the elaboration part. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</div>
</div>

@stop