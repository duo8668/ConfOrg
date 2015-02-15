@extends('layouts.dashboard.master')
@section('page-header')
  Topic Preferences
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Topic Preferences</li>
</ol>
<hr>

<div class="row">
  <div class="col-md-12">
    {{ Form::open(array('route' => 'review.save_topics', 'class' => 'form-horizontal', 'method' => 'POST')) }}
      
      <legend>Set Preferred Topics</legend>
      <!-- Topics -->
     <div class="form-group @if ($errors->has('sub_topics')) has-error @endif">
        {{ Form::label('sub_topics', 'Topics *', ['class' => 'col-sm-2 control-label']) }} 
        <div class="col-sm-10">     
          @foreach ($topics as $topic) 
            <div class="checkbox"><label>{{ Form::checkbox('sub_topics[]', $topic->topic_id, in_array($topic->topic_id, $selection)) }} {{{ $topic->topic_name}}}</label></div>
          @endforeach
          @if ($errors->has('sub_topics')) <p class="help-block">{{ $errors->first('sub_topics') }}</p> @endif
        </div>
    </div>

    <hr>
    <!-- Submit Button -->
    <div style="margin-bottom:20px;"></div>
     <div class="row">  
      <div class="col-md-8 col-md-offset-2"> 
        {{ Form::submit('Save Preference', array('class' => 'btn btn-primary btn-md btn-block')) }}
      </div>
    </div> 
    <div style="margin-bottom:40px;"></div>
    {{ Form::close() }}
  </div>
</div>
@stop