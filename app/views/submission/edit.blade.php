@extends('layouts.dashboard.master')
@section('page-header')
  Edit Submission: {{{ $submission->sub_title }}}
  {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
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
  {{ Form::model($submission, array('route' => ['submission.update', $submission->sub_id], 'files' => true, 'method' => 'PUT') ) }}
    <div class="col-md-8 col-md-offset-2">
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group">
          {{ Form::label('sub_type', 'Submission Type') }} 
          {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), null, array('class' => 'form-control')) }}
        </div>

        <!-- Submission Title-->
        <div class="form-group">
          {{ Form::label('sub_title', 'Submission Title') }}        
          {{ Form::text('sub_title', null, array('class' => 'form-control')) }}
        </div>

        <!-- Abstract -->
        <div class="form-group">
          {{ Form::label('sub_abstract', 'Abstract') }}    
          {{ Form::textarea('sub_abstract', null, array('class' => 'form-control')) }} 
        </div>

        <!-- Topics -->
        <div class="form-group">
            {{ Form::label('sub_topics', 'Topics') }} 
            @foreach ($conf_topics as $topic) 
              <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id, in_array($topic->topic_id, $sub_topics)) }} {{{ $topic->topic_name}}}</label></div>
            @endforeach
        </div>
        <!-- Keywords -->
        <?php
          $all_keyword = '';
          for ($i = 0; $i < count($keyword); $i++) {
            if ($i < count($keyword) - 1) {
              $all_keyword .= $keyword[$i]->keyword_name . ',';
            } else {
              $all_keyword .= $keyword[$i]->keyword_name;
            }
          }
        ?>
        <div class="form-group">
          {{ Form::label('sub_keywords', 'Keywords') }}     
          {{ Form::text('sub_keywords', $all_keyword, array('class' => 'form-control')) }}
        </div>
        
         <!-- Upload --> 
        <div style="margin-bottom:40px;"></div>
        <legend>File Upload</legend>       

        @if(!empty($submission->attachment_path))
          <div class="form-group">
            {{ Form::label('attachment_path', 'Upload new file') }} 
            {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
            <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
          </div>

          <div class="form-group">
            {{ Form::label('attachment_path', 'Current Attachment') }} <br />
            {{ link_to_asset($submission->attachment_path, $submission->attachment_path, $attributes = array('target' => '_blank'), $secure = null) }}
          </div> 
        @else
          <div class="form-group">
            {{ Form::label('attachment_path', 'Upload your file') }} 
            {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
            <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
          </div>
        @endif

        <!-- Additional Remarks -->
        <div class="form-group">
          {{ Form::label('sub_remarks', 'Additional Remarks') }}    
          {{ Form::textarea('sub_remarks', null, array('class' => 'form-control')) }} 
        </div>
        
        <div style="margin-bottom:20px;"></div>
        <div class="row">  
          <div class="col-md-6">
            {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-lg btn-block'])}}
          </div>
          <div class="col-md-6">
            {{ Form::submit('Update Submission', array('class' => 'btn btn-success btn-lg btn-block')) }}
          </div>
        </div> 
        <div style="margin-bottom:40px;"></div>
    </div>
   
    {{ Form::close() }}
  </div>
@stop