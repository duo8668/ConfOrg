@extends('layouts.dashboard.master')
@section('page-header')
  View Submission
  {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
@stop
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <legend>Basic Information</legend>
      <!-- Submission Type -->
      <div class="row">
        <label class="col-md-3 control-label">Submission Type</label>
        <div class="col-md-9">
          @if ($submission->sub_type === 3)
              Poster
          @elseif ($submission->sub_type === 2)
              Full Paper
          @else
              Abstract
          @endif
        </div>
      </div>

      <!-- Submission Title-->
      <div class="row">
        <label class="col-md-3 control-label">Submission Title</label>       
        <div class="col-md-9">
        {{{ $submission->sub_title }}}
        </div>
      </div>

      <!-- Abstract -->
      <div class="row">
        <label class="col-md-3 control-label">Abstract</label>
        <div class="col-md-9">   
          {{{ $submission->sub_abstract }}}               
        </div>
      </div>

      <!-- Topics -->
      <div class="row">
        <label class="col-md-3 control-label">Topics</label> 
        <div class="col-md-9">
          @foreach ($sub_topics as $topic) 
            {{{ $topic->topic_name }}}
          @endforeach
        </div>
      </div>

      <!-- Keywords -->
      <div class="row">
        <label class="col-md-3 control-label">Keywords</label>    
        <div class="col-md-9">
          @foreach ($keyword as $word) 
            {{{ $word->keyword_name }}}
          @endforeach
        </div>
      </div>

      <!-- Remarks -->
      <div class="row">
        <label class="col-md-3 control-label">Remarks</label>    
        <div class="col-md-9">
          {{{ $submission->sub_remarks }}}
        </div>
      </div>

      <!-- Upload --> 
      <div class="row">
        <label class="col-md-3 control-label">File Upload</label> 
        <div class="col-md-9">
          {{ link_to_asset($submission->attachment_path, 'Click Here to view file', $attributes = array('target' => '_blank'), $secure = null) }}
        </div>
      </div>
      <div style="margin-bottom:40px;"></div>

      {{ var_dump($sub_authors) }}
    </div>
  </div>
@stop