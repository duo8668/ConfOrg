@extends('layouts.dashboard.master')
@section('page-header')
  Add New Submission
@stop
@section('content')
 {{ Form::open(array('route' => 'submission.store', 'class' => 'form-horizontal', 'files' => true)) }}
    <fieldset>
      <legend>Basic Information</legend>
      <!-- Submission Type -->
      <div class="form-group">
        {{ Form::label('submission_type', 'Submission Type', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
          {{ Form::select('submission_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
        </div>
      </div>

      <!-- Submission Title-->
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

      <!-- Keywords -->
      <div class="form-group">
        {{ Form::label('submission_keywords', 'Keywords', array('class' => 'col-md-4 control-label')) }}     
        <div class="col-md-4">
        {{ Form::text('submission_keywords', 'Separated by commas, e.g. apples,oranges,grapes', array('class' => 'form-control input-md')) }}
        </div>
      </div>

      <!-- Upload --> 
      <div class="form-group">
        {{ Form::label('submission_filepath', 'Upload your file (Please ensure your file DOES NOT contain authors name. Failure to do so may result in paper rejection)', array('class' => 'col-md-4 control-label')) }} 
        <div class="col-md-4">
          {{ Form::file('submission_filepath', array('class' => 'input-file')) }}
        </div>
      </div>

      <legend>Authors</legend>
      <!-- Authors -->
      <div id="authors-group-1">
        <!-- First Name -->
        <div class="form-group">
          {{ Form::label('author_fname', 'First Name', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            {{ Form::text('author_fname', '', array('class' => 'form-control input-md')) }}
          </div>
        </div>

        <!-- Last Name -->
        <div class="form-group">
          {{ Form::label('author_lname', 'Last Name', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            {{ Form::text('author_lname', '', array('class' => 'form-control input-md')) }}
          </div>
        </div>

        <!-- Organization -->
        <div class="form-group">
          {{ Form::label('author_org', 'Organization', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            {{ Form::text('author_org', '', array('class' => 'form-control input-md')) }}
          </div>
        </div>

        <!-- Country -->
        <div class="form-group">
          {{ Form::label('author_country', 'Country', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            {{ Form::text('author_country', '', array('class' => 'form-control input-md')) }}
          </div>
        </div>

        <!-- Bio -->
        <div class="form-group">
          {{ Form::label('author_bio', 'Bio', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            {{ Form::textarea('author_bio', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <!-- Presenting? -->
        <div class="form-group">
          {{ Form::label('author_ispresenting', 'Presenting the paper?', array('class' => 'col-md-4 control-label')) }}     
          <div class="col-md-4">
            <div class="radio-inline">
              {{ Form::radio('author_ispresenting', '1') }} Yes
            </div>
            <div class="radio-inline">
              {{ Form::radio('author_ispresenting', '0') }} No
            </div>
          </div>
        </div>

      </div>

      <!-- Add authors button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="addauthors"></label>
        <div class="col-md-4">
          <a class="btn btn-default" id="addauthors" name="addauthors" href="#" role="button">Add More Authors</a>
        </div>
      </div>

      <!-- Button -->
      <legend>Submit</legend>
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          {{ Form::submit('Add Submission', array('class' => 'btn btn-primary btn-lg')) }}
        </div>
      </div>

    </fieldset>
    {{ Form::close() }}
@stop
