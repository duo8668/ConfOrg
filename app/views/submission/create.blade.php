@extends('layouts.dashboard.master')
@section('page-header')
  New Submission
  {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
@stop
@stop
@section('content')
<div class="row">
  {{ Form::open(array('route' => 'submission.store', 'files' => true)) }}
    <div class="col-lg-6">
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group">
          {{ Form::label('submission_type', 'Submission Type') }} 
          {{ Form::select('submission_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
        </div>

        <!-- Submission Title-->
        <div class="form-group">
          {{ Form::label('submission_title', 'Submission Title') }}        
          {{ Form::text('submission_title', '', array('class' => 'form-control')) }}
        </div>

        <!-- Abstract -->
        <div class="form-group">
          {{ Form::label('submission_abstract', 'Abstract') }}    
          {{ Form::textarea('submission_title', '', array('class' => 'form-control')) }} 
        </div>


        <!-- Topics -->
        <div class="form-group">
            {{ Form::label('submission_topics', 'Topics') }} 
            <div class="checkbox"><label>{{ Form::checkbox('submission_topics', '1') }} Physiology</label></div>
            <div class="checkbox"><label>{{ Form::checkbox('submission_topics', '2') }} Psychology</label></div>
            <div class="checkbox"><label>{{ Form::checkbox('submission_topics', '3') }} Psychiatry</label></div>
            <div class="checkbox"><label>{{ Form::checkbox('submission_topics', '4') }} Neurology</label></div>
        </div>


        <!-- Keywords -->
        <div class="form-group">
          {{ Form::label('submission_keywords', 'Keywords') }}     
          {{ Form::text('submission_keywords', 'Separated by commas, e.g. apples,oranges,grapes', array('class' => 'form-control')) }}
        </div>

        <!-- Upload --> 
        <div class="form-group">
          {{ Form::label('submission_filepath', 'Upload your file') }} 
          {{ Form::file('submission_filepath', array('class' => 'input-file')) }}
          <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
        </div>
    </div>
    <div class="col-lg-6">
        <legend>Authors</legend>
        <!-- Authors -->
        <div id="authors-group-1">
          <!-- First Name -->
          <div class="form-group">
            {{ Form::label('author_fname', 'First Name') }}     
            {{ Form::text('author_fname', '', array('class' => 'form-control')) }}
          </div>

          <!-- Last Name -->
          <div class="form-group">
            {{ Form::label('author_lname', 'Last Name') }} 
            {{ Form::text('author_lname', '', array('class' => 'form-control')) }}
          </div>

          <!-- Organization -->
          <div class="form-group">
            {{ Form::label('author_org', 'Organization') }}     
            {{ Form::text('author_org', '', array('class' => 'form-control')) }}
          </div>

          <!-- Country -->
          <div class="form-group">
            {{ Form::label('author_email', 'Email') }}     
            {{ Form::text('author_country', '', array('class' => 'form-control')) }}
            </div>
          </div>

          <!-- Presenting? -->
          <div class="form-group">
            {{ Form::label('author_ispresenting', 'Presenting the paper?') }}     
              <div class="radio-inline">{{ Form::radio('author_ispresenting', '1') }} Yes</div>
              <div class="radio-inline">{{ Form::radio('author_ispresenting', '0') }} No</div>
          </div>
        

        <!-- Add authors button -->
        <div class="form-group">          
            <a class="btn btn-default" id="addauthors" name="addauthors" href="#" role="button">Add More Authors</a>
        </div>     
    </div>

    <div class="row">  
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <!-- Button -->        
            {{ Form::submit('Add Submission', array('class' => 'btn btn-primary btn-lg btn-block')) }}
          </div>
        </div>
      </div>
    </div>    
    {{ Form::close() }}
  </div>
@stop
