@extends('layouts.dashboard.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Add New Submission</h2>
  </div>
</div>
 {{ Form::open(array('route' => 'submission.store', 'class' => 'form-horizontal', 'files' => true)) }}
    <fieldset>
      
      <!-- Submission Type -->
      <div class="form-group">
        {{ Form::label('submission_type', 'Submission Type', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
          {{ Form::select('submission_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
        </div>
      </div>

      <!-- Submission Type-->
      <div class="form-group">
        {{ Form::label('submission_title', 'Submission Title', array('class' => 'col-md-4 control-label')) }}        
        <div class="col-md-4">
        {{ Form::text('submission_title', '', array('class' => 'form-control input-md')) }}
        </div>
        
      </div>

      <!-- Abstract -->
      <div class="form-group">
        {{ Form::label('submission_abstract', 'Abstract', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">   
          {{ Form::textarea('submission_title', '', array('class' => 'form-control')) }}                  
        </div>
      </div>

      <!-- Topics -->
      <div class="form-group">
        {{ Form::label('submission_topics', 'Topics', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
        <div class="checkbox">
          {{ Form::checkbox('submission_topics', '1') }} Physiology
        </div>
        <div class="checkbox">
          {{ Form::checkbox('submission_topics', '2') }} Psychology
        </div>
        <div class="checkbox">
          {{ Form::checkbox('submission_topics', '3') }} Psychiatry        
        </div>
        <div class="checkbox">
          {{ Form::checkbox('submission_topics', '4') }} Neurology
        </div>
        </div>
      </div>

      <!-- Upload --> 
      <div class="form-group">
        {{ Form::label('submission_filepath', 'Upload your file', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
          {{ Form::file('submission_filepath', array('class' => 'input-file')) }}
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        {{ Form::label('submit', '', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
          {{ Form::submit('Add Submission', array('class' => 'btn btn-primary')) }}
        </div>
      </div>
    </fieldset>
    {{ Form::close() }}
@stop
