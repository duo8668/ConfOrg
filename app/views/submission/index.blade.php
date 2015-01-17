@extends('layouts.dashboard.master')
@section('page-header')
	Your Submissions
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
		@foreach ($submissions as $sub) 
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
				<td>
					{{ link_to_route('submission.reviews', 'Reviews', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
					{{ link_to_route('submission.edit', 'View/Edit', [$sub->sub_id], ['class' => 'btn btn-success btn-xs'])}}
					{{ Form::model($sub, ['route' => ['submission.destroy', $sub->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
						{{ Form::button('Withdraw', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'])}}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
</div>
@stop