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
  {{ Form::open(array('route' => 'submission.store', 'files' => true, 'class' => 'form-horizontal')) }}
   <div class="col-md-12">
        
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group">
          {{ Form::label('sub_type', 'Submission Type *', ['class' => 'col-sm-2 control-label']) }} 
          <div class="col-sm-2">
            {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), '1', array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="clearfix"></div>
        <!-- Submission Title-->
        <div class="form-group">
          {{ Form::label('sub_title', 'Submission Title *', ['class' => 'col-sm-2 control-label']) }}   
          <div class="col-sm-10">     
          {{ Form::text('sub_title', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <!-- Abstract -->
        <div class="form-group">
          {{ Form::label('sub_abstract', 'Abstract *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-10">     
          {{ Form::textarea('sub_abstract', '', array('class' => 'form-control')) }} 
          </div>
        </div>


        <!-- Topics -->
        <div class="form-group">
            {{ Form::label('sub_topics', 'Topics *', ['class' => 'col-sm-2 control-label']) }} 
            <div class="col-sm-10">     
          @foreach ($topics as $topic) 
              <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id) }} {{{ $topic->topic_name}}}</label></div>
            @endforeach
            </div>
        </div>


        <!-- Keywords -->
        <div class="form-group">
          {{ Form::label('sub_keywords', 'Keywords *', ['class' => 'col-sm-2 control-label']) }}     
          <div class="col-sm-10">     
          {{ Form::text('sub_keywords', '', array('class' => 'form-control', 'placeholder' => 'Separated by commas, e.g. apples,oranges,grapes')) }}
          </div>
        </div>

        <!-- Upload --> 
        <div class="form-group">
          {{ Form::label('attachment_path', 'Upload your file *', ['class' => 'col-sm-2 control-label']) }} 
         <div class="col-sm-10">     
           {{ Form::file('attachment_path', array('class' => 'input-file')) }}
          <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
          </div>
        </div>

        <!-- Additional Remarks -->
        <div class="form-group">
          {{ Form::label('sub_remarks', 'Additional Remarks', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-10">     
          {{ Form::textarea('sub_remarks', '', array('class' => 'form-control')) }} 
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
        <!-- <div class="form-group" id="author_row">
          <div class="row"  style="margin-left:30px; margin-right:30px;">
            {{ Form::label('fname', 'First Name', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('lname', 'Last Name', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('org', 'Organization', ['class' => 'col-sm-3 text-center']) }} 
            {{ Form::label('email', 'Email', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('ispresenting', 'Presenting?', ['class' => 'col-sm-2 text-center']) }} 
            {{ Form::label('author_btn', 'More', ['class' => 'col-sm-1 text-center']) }} 
          </div>
          <div class="row" style="margin-left:30px; margin-right:30px;">
            <input class="col-sm-2" name="author_lname[]" type="text" value="" id="author_lname0" required>
            <input class="col-sm-2" name="author_fname[]" type="text" value="" id="author_fname0" required>
            <input class="col-sm-3" name="author_org[]" type="text" value="" id="author_org0" required> 
            <input class="col-sm-2" name="author_email[]" type="email" value="" id="author_email0" required>
            <div class="radio-inline col-sm-2 text-center"><input name="author_ispresenting[]]" type="checkbox" value="1" id="author_ispresenting0"> Yes</div>
            <a class="btn btn-default btn-xs col-sm-1" id="addauthors" name="addauthors" role="button" onclick="addRow(this.form);">Add More</a>
          </div>
        </div> -->
    
    </div>
    <hr>
    
    <div class="row">  
      <div class="col-md-8 col-md-offset-2">
        <!-- Button -->        
        {{ Form::submit('Add Submission', array('class' => 'btn btn-primary btn-md btn-block')) }}

      </div>
    </div>    
    {{ Form::close() }}
  </div>
@stop
