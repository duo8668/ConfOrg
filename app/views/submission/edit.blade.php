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
  {{ Form::model($submission, array('route' => ['submission.update', $submission->sub_id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal') ) }}
    <div class="col-md-12">
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group">
          {{ Form::label('sub_type', 'Submission Type *', ['class' => 'col-sm-2 control-label']) }} 
          <div class="col-sm-2">
            {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), null, array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="clearfix"></div>
        <!-- Submission Title-->
        <div class="form-group">
          {{ Form::label('sub_title', 'Submission Title *', ['class' => 'col-sm-2 control-label']) }}   
          <div class="col-sm-10">     
          {{ Form::text('sub_title', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <!-- Abstract -->
        <div class="form-group">
          {{ Form::label('sub_abstract', 'Abstract *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-10">     
          {{ Form::textarea('sub_abstract', null, array('class' => 'form-control')) }} 
          </div>
        </div>

        <!-- Topics -->
        <div class="form-group">
            {{ Form::label('sub_topics', 'Topics *', ['class' => 'col-sm-2 control-label']) }} 
            <div class="col-sm-10">     
          @foreach ($conf_topics as $topic) 
              <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id, in_array($topic->topic_id, $sub_topics)) }} {{{ $topic->topic_name}}}</label></div>
            @endforeach
            </div>
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
          {{ Form::label('sub_keywords', 'Keywords *', ['class' => 'col-sm-2 control-label']) }}     
          <div class="col-sm-10">     
          {{ Form::text('sub_keywords', $all_keyword, array('class' => 'form-control')) }}
          </div>
        </div>

        
         <!-- Upload --> 
        @if(!empty($submission->attachment_path))
          <div class="form-group">
            {{ Form::label('attachment_path', 'Upload New File', ['class' => 'col-sm-2 control-label']) }} 
             <div class="col-sm-10">     
                {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
                <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('attachment_path', 'Current Attachment', ['class' => 'col-sm-2 control-label']) }} <br />
            <div class="col-sm-10">     
              {{ link_to_asset($submission->attachment_path, $submission->attachment_path, $attributes = array('target' => '_blank'), $secure = null) }}
            </div>
          </div> 
        @else
          <div class="form-group">
            {{ Form::label('attachment_path', 'Upload Your File', ['class' => 'col-sm-2 control-label']) }} 
             <div class="col-sm-10">     
                {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
                <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
            </div>
          </div>
        @endif


        <!-- Additional Remarks -->
        <div class="form-group">
          {{ Form::label('sub_remarks', 'Additional Remarks', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-10">     
          {{ Form::textarea('sub_remarks', null, array('class' => 'form-control')) }} 
          </div>
        </div>
        
        <hr>
        <div style="margin-bottom:30px;"></div>
        <div class="row">  
          <div class="col-md-4 col-md-offset-2">
            {{ Form::submit('Update Submission', array('class' => 'btn btn-success btn-md btn-block')) }}
          </div>
          <div class="col-md-4 col-md-offset-6" style="margin-left:0;">
            {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-md btn-block'])}}
          </div>
      </div> 
        <div style="margin-bottom:40px;"></div>
    </div>
   
    {{ Form::close() }}
  </div>
@stop