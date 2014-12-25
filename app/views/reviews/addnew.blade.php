@extends('layouts.dashboard.master')
@section('page-header')
  Add Review to Current Submission
@stop
@section('content')
<style>
.form-horizontal .control-label { padding-top: 0px; }
.narrower { width: 30%; }
</style>
 {{ Form::open(array('route' => 'review.store', 'class' => 'form-horizontal')) }}
    <fieldset>
      <legend>Basic Information</legend>
      <!-- Submission Type -->
      <div class="form-group">
        <label class="col-md-4 control-label">Submission Type</label>
        <div class="col-md-4">
          Abstract
        </div>
      </div>

      <!-- Submission Title-->
      <div class="form-group">
        <label class="col-md-4 control-label">Submission Title</label>       
        <div class="col-md-4">
        How I Met Your Mother
        </div>
      </div>

      <!-- Abstract -->
      <div class="form-group">
        <label class="col-md-4 control-label">Abstract</label>
        <div class="col-md-4">   
          Lorem Ipsum dolor sit amet                 
        </div>
      </div>

      <!-- Topics -->
      <div class="form-group">
        <label class="col-md-4 control-label">Topics</label> 
        <div class="col-md-4">
          Psychology, Physiology
        </div>
      </div>

      <!-- Keywords -->
      <div class="form-group">
        <label class="col-md-4 control-label">Keywords</label>    
        <div class="col-md-4">
          Family, Friends
        </div>
      </div>

      <!-- Upload --> 
      <div class="form-group">
        <label class="col-md-4 control-label">File Upload</label> 
        <div class="col-md-4">
          No file is uploaded
        </div>
      </div>

      <!-- Button -->
      <legend>Add Your Review</legend>

      <!-- Scores -->
      <div class="form-group">
        {{ Form::label('quality_score', 'Quality', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('quality_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('originality_score', 'Originality', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('originality_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('relevance_score', 'Relevance', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('relevance_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('significance_score', 'Significance', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('significance_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('presentation_score', 'Presentation', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('presentation_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <!-- Recommendation -->
      <div class="form-group">
        {{ Form::label('recomm_score', 'Overall Recommendation', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('recomm_score', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <!-- Reviewer Familiarity -->
      <div class="form-group">
        {{ Form::label('reviewer_familiarity', 'How familiar are you with the topics?', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::number('reviewer_familiarity', '0', array('class' => 'form-control input-md narrower', 'min' => "0", 'max' => "10")) }}
        </div>
      </div>

      <!-- Comments -->
      <div class="form-group">
        {{ Form::label('reviewer_comment', 'Comments', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::textarea('reviewer_comment', '', array('class' => 'form-control')) }}
        </div>
      </div>

      <!-- Internal Comments -->
      <div class="form-group">
        {{ Form::label('reviewer_intcomment', 'Internal Comments', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
            {{ Form::textarea('reviewer_intcomment', 'This comment will not be visible to the authors', array('class' => 'form-control')) }}
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          {{ Form::submit('Add Review', array('class' => 'btn btn-primary btn-lg')) }}
        </div>
      </div>

    </fieldset>
    {{ Form::close() }}
@stop
