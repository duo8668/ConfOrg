@extends('layouts.dashboard.master')
@section('page-header')
  New Submission
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Add Submission</li>
</ol>
<hr>

<div class="row">
  {{ Form::open(array('route' => 'submission.store', 'files' => true, 'class' => 'form-horizontal')) }}
   <div class="col-md-12">
        
        <legend>Basic Information</legend>
        <!-- Conference Name -->
        <div class="form-group">
          <label class="col-md-2 control-label">Submitting To</label>
          <div class="col-md-10">
            <p class="form-control-static"><strong>{{ link_to_route('conference.public_detail', $conference->title, ['conf_id' => $conference->conf_id]) }}</strong></p>
          </div>
        </div>
        <!-- Submission Type -->
        <div class="form-group @if ($errors->has('sub_type')) has-error @endif">
          {{ Form::label('sub_type', 'Submission Type *', ['class' => 'col-md-2 control-label']) }} 
          <div class="col-md-2">
            {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
            @if ($errors->has('sub_type')) <p class="help-block">{{ $errors->first('sub_type') }}</p> @endif
          </div>
        </div>
        <div class="clearfix"></div>
        <!-- Submission Title-->
        <div class="form-group @if ($errors->has('sub_title')) has-error @endif">
          {{ Form::label('sub_title', 'Submission Title *', ['class' => 'col-md-2 control-label']) }}   
          <div class="col-md-10">     
          {{ Form::text('sub_title', null, array('class' => 'form-control')) }}
          @if ($errors->has('sub_title')) <p class="help-block">{{ $errors->first('sub_title') }}</p> @endif
          </div>
        </div>

        <!-- Abstract -->
        <div class="form-group @if ($errors->has('sub_abstract')) has-error @endif">
          {{ Form::label('sub_abstract', 'Abstract *', ['class' => 'col-md-2 control-label']) }}    
          <div class="col-md-10">     
          {{ Form::textarea('sub_abstract', null, array('class' => 'form-control')) }} 
          @if ($errors->has('sub_abstract')) <p class="help-block">{{ $errors->first('sub_abstract') }}</p> @endif
          </div>
        </div>


        <!-- Topics -->
        <div class="form-group @if ($errors->has('sub_topics')) has-error @endif">
            {{ Form::label('sub_topics', 'Topics *', ['class' => 'col-md-2 control-label']) }} 
            <div class="col-md-10">     
              @foreach ($topics as $topic) 
                <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id) }} {{{ $topic->topic_name}}}</label></div>
              @endforeach
              @if ($errors->has('sub_topics')) <p class="help-block">{{ $errors->first('sub_topics') }}</p> @endif
            </div>
        </div>


        <!-- Keywords -->
        <div class="form-group @if ($errors->has('sub_keywords')) has-error @endif">
          {{ Form::label('sub_keywords', 'Keywords *', ['class' => 'col-md-2 control-label']) }}     
          <div class="col-md-10">     
            {{ Form::text('sub_keywords', null, array('class' => 'form-control', 'placeholder' => 'Separated by commas, e.g. apples,oranges,grapes')) }}
            @if ($errors->has('sub_keywords')) <p class="help-block">{{ $errors->first('sub_keywords') }}</p> @endif
          </div>
        </div>

        <!-- Upload --> 
        <div class="form-group @if ($errors->has('attachment_path')) has-error @endif">
          {{ Form::label('attachment_path', 'Upload your file *', ['class' => 'col-md-2 control-label']) }} 
         <div class="col-md-10">    
          <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p> 
           {{ Form::file('attachment_path', array('class' => 'input-file')) }}
          @if ($errors->has('attachment_path')) <p class="help-block">{{ $errors->first('attachment_path') }}</p> @endif
          </div>
        </div>

        <!-- Additional Remarks -->
        <div class="form-group @if ($errors->has('sub_remarks')) has-error @endif">
          {{ Form::label('sub_remarks', 'Additional Remarks', ['class' => 'col-md-2 control-label']) }}    
          <div class="col-md-10">     
          {{ Form::textarea('sub_remarks', null, array('class' => 'form-control')) }} 
           @if ($errors->has('sub_remarks')) <p class="help-block">{{ $errors->first('sub_remarks') }}</p> @endif
          </div>
        </div>

        <div style="margin-top:30px;"></div>
        <legend>Authors</legend>
        <p class="help-block">Please input all authors' information detail here. </p>
        <!-- Authors -->
        <div id="author_row">
          <div class="form-inline">
            <div class="form-group author-inline-form">
              <label>Author 1: </label>
            </div>
            
            <div class="form-group author-inline-form">
              <label class="sr-only" for="author_fname0">First Name</label>
              <input type="text" value="" class="form-control" id="author_fname0" placeholder="First name" name="author_fname[]" required>
            </div>

            <div class="form-group author-inline-form">
              <label class="sr-only" for="author_lname0">Last Name</label>
              <input type="text" value="" class="form-control" id="author_lname0" placeholder="Last name" name="author_lname[]" required>
            </div>

            <div class="form-group author-inline-form">
              <label class="sr-only" for="author_org0">Organization</label>
              <input type="text" value="" class="form-control" id="author_org0" placeholder="Organization" name="author_org[]" required>
            </div>

            <div class="form-group author-inline-form">
              <label class="sr-only" for="author_email0">Email</label>
              <input type="email" value="" class="form-control" id="author_email0" placeholder="Email" name="author_email[]" required>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" name="author_ispresenting[]" value="1" id="author_ispresenting0"> This author is presenting
              </label>
            </div> 
            
            <div class="form-group author-inline-form">
              <a class="btn btn-default btn-xs" id="addauthors" name="addauthors" role="button" onclick="addRow(this.form);">Add More</a>
            </div>
          </div>
    
    </div>
    <hr>
    
    <div class="row">  
      <div class="col-md-8 col-md-offset-2">
        <!-- Button -->     
        {{ Form::hidden('conf_id', $conference->conf_id) }}   
        {{ Form::submit('Add Submission', array('class' => 'btn btn-primary btn-md btn-block')) }}

      </div>
    </div>    
    {{ Form::close() }}
  </div>
@stop
