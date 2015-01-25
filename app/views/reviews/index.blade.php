@extends('layouts.dashboard.master')
@section('page-header')
	Select Submissions
@stop
@section('content')
<div class="table-responsive">
  	<table class="table">   
  		<tr>
			<td>ID</td>
			<td>Title</td>
			<td>Type</td>
			<td>Topics</td>
			<td>Option</td>
		</tr> 
		@foreach ($submission as $sub) 
			<tr>
				<td>{{{ $sub->sub_id }}}</td>
				<td>{{{ $sub->sub_title }}}</td>
				<td>
					@if ($sub->sub_type === 3)
					    Poster
					@elseif ($sub->sub_type === 2)
					    Full Paper
					@else
					    Abstract
					@endif
				</td>
				<td>Topics Here</td>
				<td>{{ link_to_route('reviews.add', 'Enter Reviews', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
					{{ link_to_route('submission.reviews', 'See Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop