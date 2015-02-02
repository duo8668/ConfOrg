@extends('layouts.dashboard.master')
@section('page-header')
  Edit Authors: {{{ $submission->sub_title }}}
  {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
@stop
@section('content')
@if($errors->any())
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-danger">
        <div class="panel-heading"><h3 class="panel-title">Error!</h3></div>
        <div class="panel-body">
          @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endif
<div class="row">
  {{ Form::model($submission, array('route' => ['submission.update_authors', $submission->sub_id], 'method' => 'PUT') ) }}
    <div class="col-md-8 col-md-offset-2">
        <legend>Authors</legend>
        <!-- TODO: LIST DOWN ALL AUTHORS -->
    </div>
  {{ Form::close() }}
</div>
@stop