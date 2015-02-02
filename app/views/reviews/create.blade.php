@extends('layouts.dashboard.master')
@section('page-header')
  Add Review to Current Submission
  {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
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
          <strong>{{{ $submission->sub_title }}}</strong>
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
          {{ link_to_asset($submission->attachment_path, 'View File', $attributes = array('target' => '_blank'), $secure = null) }}
        </div>
      </div>

      <div style="margin-bottom:40px;"></div>
    {{ Form::open(array('route' => 'review.store', 'class' => 'form-horizontal')) }}
    <fieldset>
      <!-- Button -->
      <legend>Score and Comments</legend>

      <!-- Scores -->
      <div class="form-group">
        <div class="row col-sm-offset-1" >
          {{ Form::label('quality_score', 'Quality', ['class' => 'col-sm-2 text-center']) }} 
          {{ Form::label('originality_score', 'Originality', ['class' => 'col-sm-2 text-center']) }} 
          {{ Form::label('relevance_score', 'Relevance', ['class' => 'col-sm-2 text-center']) }} 
          {{ Form::label('significance_score', 'Significance', ['class' => 'col-sm-2 text-center']) }} 
          {{ Form::label('presentation_score', 'Presentation', ['class' => 'col-sm-2 text-center']) }} 
        </div>
        <div class="row col-sm-offset-1">
          <div class="col-sm-2">
            {{ Form::number('quality_score', '0', array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
          <div class="col-sm-2">
            {{ Form::number('originality_score', '0', array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
          <div class="col-sm-2">
            {{ Form::number('relevance_score', '0', array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>            
          <div class="col-sm-2">
            {{ Form::number('significance_score', '0', array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
          <div class="col-sm-2">
            {{ Form::number('presentation_score', '0', array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
      </div>
      <div style="margin-bottom:40px;"></div>

      <!-- Comments -->
      <div class="form-group">
        {{ Form::label('comment', 'Your Comment *') }}     
        <p class="help-block">Please clearly and explain your evaluation and/or input in detail and in objective and constructive manner.</p>
        {{ Form::textarea('comment', '', array('class' => 'form-control')) }}
      </div>

      <!-- Internal Comments -->
      <div class="form-group">
        {{ Form::label('internal_comment', 'Internal Comments') }}    
        <p class="help-block">This comment will not be visible to the authors</p> 
        {{ Form::textarea('internal_comment', '', array('class' => 'form-control')) }}
      </div>
    </fieldset>

    <!-- Submit Button -->
    <div style="margin-bottom:20px;"></div>
    <div class="row">  
      <div class="col-md-6">
        {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-lg btn-block'])}}
      </div>
      <div class="col-md-6">
        {{ Form::hidden('hidden_sub_id', $submission->sub_id) }}
        {{ Form::submit('Add Review', array('class' => 'btn btn-primary btn-lg btn-block')) }}
      </div>
    </div> 
    <div style="margin-bottom:40px;"></div>
    {{ Form::close() }}
  </div>
</div>
@stop
