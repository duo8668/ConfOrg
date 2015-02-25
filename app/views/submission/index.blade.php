@extends('layouts.dashboard.master')
@section('page-header')
	Your Submissions
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Your Submissions</li>
</ol>
<hr>

{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Submissions</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
	<div class="table-responsive">
	  	<table class="table table-striped">  
	  		<thead>
                <tr class="filters">
                    <th style="width: 20%;"><input type="text" class="form-control" placeholder="Submission Title" disabled></th>
                    <th style="width: 8%;"><input type="text" class="form-control" placeholder="Type" disabled></th>
                    <th style="width: 25%;"><input type="text" class="form-control" placeholder="Conference" disabled></th>
                    <th style="width: 14%;"><input type="text" class="form-control" placeholder="Date Submitted" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                    <th style="width: 25%;"></th>
                </tr>
            </thead> 
			@foreach ($submissions as $sub) 
				<tr class="@if ($sub->status === 1) success @elseif ($sub->status === 9) danger @endif">
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
					<td>{{{ $sub->title }}} </td>
					<td>{{ date("d F Y",strtotime($sub->created_at)) }} at {{ date("g:ha",strtotime($sub->created_at)) }}</td>
					<td>
						@if ($sub->status === 1)
						    <span class="text-success"><strong>Accepted</strong></span>
						@elseif ($sub->status === 9)
						    <span class="text-danger"><strong>Rejected</strong></span>
						@else
						    On review
						@endif
					</td>
					<td>
						{{ link_to_route('submission.reviews', 'Reviews', [$sub->sub_id], ['class' => 'btn btn-default btn-xs'])}}
						{{ link_to_route('submission.show', 'View/Edit Submission', [$sub->sub_id], ['class' => 'btn btn-info btn-xs'])}}
						@if ($sub->status === 0)
							{{ Form::model($sub, ['route' => ['submission.destroy', $sub->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
								{{ Form::button('Withdraw', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'])}}
							{{ Form::close() }}
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	</div>
    </div>
</div>
@stop