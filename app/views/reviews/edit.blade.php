@extends('layouts.dashboard.master')
@section('page-header')
  Update Your Review
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
    {{ Form::model($review, array('route' => ['review.update', $review->review_id], 'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <fieldset>
      <!-- Button -->
      <legend>Score and Comments</legend>
      <p class="help-block">Please assign scores for each criteris for the current submission. The score must range between 0 to 10.</p>
      <!-- Scores -->
        <div class="form-group">
          {{ Form::label('quality_score', 'Quality *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('quality_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
          {{ Form::label('originality_score', 'Originality *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('originality_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
          {{ Form::label('relevance_score', 'Relevance *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('relevance_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
          {{ Form::label('significance_score', 'Significance *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('significance_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
          {{ Form::label('presentation_score', 'Presentation *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('presentation_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        </div>
        <div class="clearfix"></div>        
      
      <!-- Comments -->
      <div class="form-group">
        {{ Form::label('comment', 'Your Comment *', ['class' => 'col-sm-2 control-label']) }}    
        <div class="col-sm-10">     
          <p class="help-block">Please clearly and explain your evaluation and/or input in detail and in objective and constructive manner.</p>
        {{ Form::textarea('comment', null, array('class' => 'form-control')) }} 
        </div>
      </div>
      

      <!-- Internal Comments -->
      <div class="form-group">
        {{ Form::label('internal_comment', 'Internal Comments', ['class' => 'col-sm-2 control-label']) }}    
        <div class="col-sm-10">     
          <p class="help-block">This comment will not be visible to the authors</p> 
        {{ Form::textarea('internal_comment', null, array('class' => 'form-control')) }} 
        </div>
      </div>
    </fieldset>
    <hr>
    <!-- Submit Button -->
    <div style="margin-bottom:20px;"></div>
    <div class="row">  
      <div class="col-md-6">
        {{ Form::hidden('hidden_sub_id', $submission->sub_id) }}
        {{ Form::submit('Update Review', array('class' => 'btn btn-primary btn-md')) }}
        {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-md'])}}
      </div>
    </div> 
    <div style="margin-bottom:40px;"></div>
    {{ Form::close() }}
  </div>
</div>
@stop
