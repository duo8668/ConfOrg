@extends('layouts.dashboard.master')
@section('page-header')
  New Submission
  {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
@stop
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
  {{ Form::open(array('route' => 'submission.store', 'files' => true)) }}
   <div class="col-md-8 col-md-offset-2">
        
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group">
          {{ Form::label('sub_type', 'Submission Type *') }} 
          {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
        </div>

        <!-- Submission Title-->
        <div class="form-group">
          {{ Form::label('sub_title', 'Submission Title *') }}        
          {{ Form::text('sub_title', '', array('class' => 'form-control')) }}
        </div>

        <!-- Abstract -->
        <div class="form-group">
          {{ Form::label('sub_abstract', 'Abstract *') }}    
          {{ Form::textarea('sub_abstract', '', array('class' => 'form-control')) }} 
        </div>


        <!-- Topics -->
        <div class="form-group">
            {{ Form::label('sub_topics', 'Topics *') }} 
            @foreach ($topics as $topic) 
              <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id) }} {{{ $topic->topic_name}}}</label></div>
            @endforeach
        </div>


        <!-- Keywords -->
        <div class="form-group">
          {{ Form::label('sub_keywords', 'Keywords *') }}     
          {{ Form::text('sub_keywords', '', array('class' => 'form-control', 'placeholder' => 'Separated by commas, e.g. apples,oranges,grapes')) }}
        </div>

        <!-- Upload --> 
        <div class="form-group">
          {{ Form::label('attachment_path', 'Upload your file *') }} 
          {{ Form::file('attachment_path', array('class' => 'input-file')) }}
          <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
        </div>

        <!-- Additional Remarks -->
        <div class="form-group">
          {{ Form::label('sub_remarks', 'Additional Remarks') }}    
          {{ Form::textarea('sub_remarks', '', array('class' => 'form-control')) }} 
        </div>

        <hr>
        <legend>Authors</legend>
        <!-- Authors -->
        <div class="form-group" id="author_row">
          <div class="row">
            {{ Form::label('fname', 'First Name', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('lname', 'Last Name', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('org', 'Organization', ['class' => 'col-sm-3 text-center']) }} 
            {{ Form::label('email', 'Email', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('ispresenting', 'Presenting?', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('author_btn', 'More', ['class' => 'col-sm-1 text-center']) }} 
          </div>
          <div class="row">
            <input class="col-sm-2" name="author_lname[]" type="text" value="" id="author_lname0" required>
            <input class="col-sm-2" name="author_fname[]" type="text" value="" id="author_fname0" required>
            <input class="col-sm-3" name="author_org[]" type="text" value="" id="author_org0" required> 
            <input class="col-sm-2" name="author_email[]" type="email" value="" id="author_email0" required>
            <div class="radio-inline col-sm-2 text-center"><input name="author_ispresenting[]]" type="checkbox" value="1" id="author_ispresenting0"> Yes</div>
            <a class="btn btn-default btn-xs col-sm-1" id="addauthors" name="addauthors" role="button" onclick="addRow(this.form);">Add More</a>
          </div>
        </div>
        <div style="margin-bottom:40px;"></div>
    </div>

    <div class="row">  
      <div class="col-md-8 col-md-offset-2">
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
