@extends('layouts.dashboard.master')
@section('page-header')
  View Submission
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('submission.index') }}">Your Submissions</a></li>
  <li class="active"> {{{ $submission->sub_title }}}</li>
</ol>
<hr>

<div class="row">
  <div class="col-md-12">
    <legend>Basic Information</legend>

      <!-- Submission Type -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Submission Type</label>
        <div class="col-md-10">
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
        <label class="col-md-2 control-label text-right">Submission Title</label>       
        <div class="col-md-10">
          <strong>{{{ $submission->sub_title }}}</strong>
        </div>
      </div>

      <!-- Abstract -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Abstract</label>
        <div class="col-md-10">   
          {{{ $submission->sub_abstract }}}               
        </div>
      </div>

      <!-- Topics -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Topics</label> 
        <div class="col-md-10">
          @foreach ($sub_topics as $topic) 
            {{{ $topic->topic_name }}}
          @endforeach
        </div>
      </div>

      <!-- Keywords -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Keywords</label>    
        <div class="col-md-10">
          @foreach ($keyword as $word) 
            {{{ $word->keyword_name }}}
          @endforeach
        </div>
      </div>

      <!-- Remarks -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Remarks</label>    
        <div class="col-md-10">
          {{{ $submission->sub_remarks }}}
        </div>
      </div>

      <!-- Upload --> 
      
      <div class="row">
        <label class="col-md-2 control-label text-right">File Upload</label> 
        <div class="col-md-10">
          @if(!empty($submission->attachment_path))
            {{ link_to_asset($submission->attachment_path, 'View File', $attributes = array('target' => '_blank'), $secure = null) }}
          @else
            No File Uploaded
          @endif
        </div>
      </div>

      <div style="margin-bottom:40px;"></div>
      <div class="row">
        <div class="col-md-5 col-md-offset-7">
          {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-sm'])}}
        
          {{ link_to_route('submission.edit', 'Edit Basic Info', [$submission->sub_id], ['class' => 'btn btn-info btn-sm'])}}
        
          {{ Form::model($submission, ['route' => ['submission.destroy', $submission->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
            {{ Form::button('Withdraw Submission', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
          {{ Form::close() }}
        </div>
      </div>
      <div style="margin-bottom:40px;"></div>

      <legend>Authors</legend>
      <div class="row">
        <label class="col-md-2 control-label text-right">Presenting Authors</label>    
        <div class="col-md-10">
          @foreach ($sub_authors as $author) 
            @if ($author->is_presenting > 0) 
              {{{ $author->last_name }}}, {{{ $author->first_name }}}. <em>{{{ $author->organization }}}.</em> {{{ $author->email }}} <br /> 
            @endif
          @endforeach
        </div>
      </div>
      <div style="margin-bottom:20px;"></div>
      <div class="row">
        <label class="col-md-2 control-label text-right">Non-Presenting Authors</label>    
        <div class="col-md-10">
          @foreach ($sub_authors as $author) 
            @if ($author->is_presenting == 0) 
              {{{ $author->last_name }}}, {{{ $author->first_name }}}. <em>{{{ $author->organization }}}.</em> {{{ $author->email }}}<br /> 
            @endif
          @endforeach
        </div>
      </div>

      <div style="margin-bottom:40px;"></div>
      <div class="row">
        <div class="col-md-5 col-md-offset-7">
          {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-sm'])}}
        
          {{ link_to_route('submission.edit_authors', 'Edit Authors Info', [$submission->sub_id], ['class' => 'btn btn-info btn-sm'])}}
        
          {{ Form::model($submission, ['route' => ['submission.destroy', $submission->sub_id], 'method' => 'delete', 'class' => 'inline' ]) }}
            {{ Form::button('Withdraw Submission', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
          {{ Form::close() }}
        </div>
      </div>
      <div style="margin-bottom:40px;"></div>
    </div>
  </div>
@stop