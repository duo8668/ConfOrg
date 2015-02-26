@extends('layouts.dashboard.master')
@section('page-header')
  Edit Submission: {{{ $submission->sub_title }}}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('submission.index') }}">Your Submissions</a></li>
  <li>{{ link_to_route( 'submission.show', $submission->sub_title, ['id' => $submission->sub_id] ) }}</li>
  <li class="active">Edit Submission</li>
</ol>
<hr>

<div class="row">
  {{ Form::model($submission, array('route' => ['submission.update', $submission->sub_id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal') ) }}
    <div class="col-md-12">
        <legend>Basic Information</legend>
        <!-- Submission Type -->
        <div class="form-group @if ($errors->has('sub_type')) has-error @endif">
          {{ Form::label('sub_type', 'Submission Type *', ['class' => 'col-md-2 control-label']) }} 
          <div class="col-md-2">
            {{ Form::select('sub_type', array('1' => 'Abstract', '2' => 'Full Paper', '3' => 'Poster'), null, array('class' => 'form-control')) }}
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
            {{ Form::label('sub_topics', 'Topics *', ['class' => 'col-sm-2 control-label']) }} 
            <div class="col-sm-10">     
              @foreach ($conf_topics as $topic) 
                <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id, in_array($topic->topic_id, $sub_topics)) }} {{{ $topic->topic_name}}}</label></div>
              @endforeach
              @if ($errors->has('sub_topics')) <p class="help-block">{{ $errors->first('sub_topics') }}</p> @endif
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
        <div class="form-group @if ($errors->has('sub_keywords')) has-error @endif">
          {{ Form::label('sub_keywords', 'Keywords *', ['class' => 'col-sm-2 control-label']) }}     
          <div class="col-sm-10">     
            {{ Form::text('sub_keywords', $all_keyword, array('class' => 'form-control')) }}
            @if ($errors->has('sub_keywords')) <p class="help-block">{{ $errors->first('sub_keywords') }}</p> @endif
          </div>
        </div>

        
         <!-- Upload --> 
        @if(!empty($submission->attachment_path))
          <div class="form-group @if ($errors->has('attachment_path')) has-error @endif">
            {{ Form::label('attachment_path', 'Upload New File', ['class' => 'col-sm-2 control-label']) }} 
             <div class="col-sm-10">     
                <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
                {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
                @if ($errors->has('attachment_path')) <p class="help-block">{{ $errors->first('attachment_path') }}</p> @endif   
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('attachment_path', 'Current Attachment', ['class' => 'col-sm-2 control-label']) }} <br />
            <div class="col-sm-10">     
              {{ link_to_asset($submission->attachment_path, $submission->attachment_path, $attributes = array('target' => '_blank'), $secure = null) }}
            </div>
          </div> 
        @else
          <div class="form-group @if ($errors->has('attachment_path')) has-error @endif">
            {{ Form::label('attachment_path', 'Upload Your File', ['class' => 'col-sm-2 control-label']) }} 
             <div class="col-sm-10">     
                <p class="help-block">Please ensure your file DOES NOT contain authors name (anonymous). Failure to do so may result in paper rejection</p>
                {{ Form::file('attachment_path', null,  array('class' => 'input-file')) }}
                @if ($errors->has('attachment_path')) <p class="help-block">{{ $errors->first('attachment_path') }}</p> @endif 
            </div>
          </div>
        @endif


        <!-- Additional Remarks -->
        <div class="form-group @if ($errors->has('sub_remarks')) has-error @endif">
          {{ Form::label('sub_remarks', 'Additional Remarks', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-10">     
          {{ Form::textarea('sub_remarks', null, array('class' => 'form-control')) }} 
          @if ($errors->has('sub_remarks')) <p class="help-block">{{ $errors->first('sub_remarks') }}</p> @endif
          </div>
        </div>
        
        <hr>
        <div style="margin-bottom:30px;"></div>
        <div class="row">  
          <div class="col-md-4 col-md-offset-2">
            {{ Form::hidden('conf_id', $submission->conf_id) }}
            {{ Form::submit('Update Submission', array('class' => 'btn btn-primary btn-md btn-block')) }}
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