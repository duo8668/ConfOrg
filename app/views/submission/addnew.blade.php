@extends('layouts.dashboard.master')
@section('content')
 {{ Form::open(array('route' => 'submission.store', 'class' => 'form-horizontal')) }}
    <fieldset>
    <!-- Form Name -->
    <legend>Add New Submission</legend>

    <!-- Submission Type -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_type">Submission Type</label>
      <div class="col-md-4">
        <select id="submission_type" name="submission_type" class="form-control">
          <option value="abstract">Abstract</option>
          <option value="fullpaper">Full Paper</option>
          <option value="poster">Poster</option>
        </select>
      </div>
    </div>

    <!-- Submission Type-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_title">Submission Type</label>  
      <div class="col-md-4">
      <input id="submission_title" name="submission_title" type="text" placeholder="Title" class="form-control input-md" required="">
      </div>
    </div>

    <!-- Abstract -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_abstract">Abstract</label>
      <div class="col-md-4">                     
        <textarea class="form-control" id="submission_abstract" name="submission_abstract">Abstract</textarea>
      </div>
    </div>

    <!-- Topics -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_topics">Topics</label>
      <div class="col-md-4">
      <div class="checkbox">
        <label for="submission_topics-0">
          <input type="checkbox" name="submission_topics" id="submission_topics-0" value="1">
          Physiology
        </label>
      </div>
      <div class="checkbox">
        <label for="submission_topics-1">
          <input type="checkbox" name="submission_topics" id="submission_topics-1" value="2">
          Psychology
        </label>
      </div>
      <div class="checkbox">
        <label for="submission_topics-2">
          <input type="checkbox" name="submission_topics" id="submission_topics-2" value="3">
          Psychiatry
        </label>
      </div>
      <div class="checkbox">
        <label for="submission_topics-3">
          <input type="checkbox" name="submission_topics" id="submission_topics-3" value="4">
          Neurology
        </label>
      </div>
      </div>
    </div>

    <!-- Keywords-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_keywords">Keywords</label>  
      <div class="col-md-4">
      <input id="submission_keywords" name="submission_keywords" type="text" placeholder="e.g. autism, schizoprenia, etc." class="form-control input-md">
        
      </div>
    </div>

    <!-- Upload --> 
    <div class="form-group">
      <label class="col-md-4 control-label" for="submission_filepath">Upload Your File</label>
      <div class="col-md-4">
        <input id="submission_filepath" name="submission_filepath" class="input-file" type="file">
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">
        <button id="submit" name="submit" class="btn btn-primary">Add Submission</button>
      </div>
    </div>
    </fieldset>
    {{ Form::close() }}

@stop
