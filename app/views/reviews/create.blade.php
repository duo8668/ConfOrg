@extends('layouts.dashboard.master')
@section('page-header')
  Add Review to Current Submission
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('review.index') }}">Reviews</a></li>
  <li class="active">Add Review</li>
</ol>
<hr>

<div class="row">
  <div class="col-md-12">
    {{ Form::open(array('route' => 'review.store', 'class' => 'form-horizontal')) }}
    
     @include('reviews._formpartials')

    <!-- Submit Button -->
    <div style="margin-bottom:30px;"></div>
    <div class="row">  
      <div class="col-md-4 col-md-offset-2">
        {{ Form::hidden('hidden_sub_id', $submission->sub_id) }}
        {{ Form::submit('Add Review', array('class' => 'btn btn-primary btn-md btn-block')) }}
      </div>
      <div class="col-md-4 col-md-offset-6" style="margin-left:0;">
        {{ link_to_route('reviews.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-md  btn-block'])}}
      </div>
    </div> 
    <div style="margin-bottom:40px;"></div>
    {{ Form::close() }}
  </div>
</div>
@stop
