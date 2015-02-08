@extends('layouts.dashboard.master')
@section('page-header')
  Edit Authors: {{{ $submission->sub_title }}}
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
  {{ Form::open(array('route' => ['submission.update_authors', $submission->sub_id], 'method' => 'PUT') ) }}
    <div class="col-md-12">
        <legend>Authors</legend>
        <div id="author_row">
        <?php
          for ($i = 0; $i < count($authors); $i++) {
           echo '<div class="form-inline" id="rowNum' . $i .'" style="margin-top:10px;">
              <div class="form-group author-inline-form">
                <label>Author ' . ($i + 1) . ': </label>
              </div>

              <div class="form-group author-inline-form">
                <label class="sr-only" for="author_fname'. $i .'">First Name</label>
                <input type="text" value="'. $authors[$i]->first_name .'" class="form-control" id="author_fname'. $i .'" placeholder="First name" name="author_fname[]" required>
              </div>

              <div class="form-group author-inline-form">
                <label class="sr-only" for="author_lname'. $i .'">Last Name</label>
                <input type="text" value="'. $authors[$i]->last_name .'" class="form-control" id="author_lname'. $i .'" placeholder="Last name" name="author_lname[]" required>
              </div>

              <div class="form-group author-inline-form">
                <label class="sr-only" for="author_org'. $i .'">Organization</label>
                <input type="text" value="'. $authors[$i]->organization .'" class="form-control" id="author_org'. $i .'" placeholder="Organization" name="author_org[]" required>
              </div>

              <div class="form-group author-inline-form">
                <label class="sr-only" for="author_email'. $i .'">Email</label>
                <input type="email" value="'. $authors[$i]->email .'" class="form-control" id="author_email'. $i .'" placeholder="Email" name="author_email[]" required>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="author_ispresenting[]" value="1" id="author_ispresenting'. $i .'" ' . ($authors[$i]->is_presenting > 0 ? 'checked' : '') .'> This author is presenting
                </label>
              </div>'; 
            if ( $i == 0 ) {
              echo '<div class="form-group author-inline-form">
                <a class="btn btn-default btn-xs" id="addauthors" name="addauthors" role="button" onclick="addRowUpdate(this.form,'. count($authors).');">Add More</a>
              </div>';
            } else {
              echo '<div class="form-group author-inline-form">
              <input type="button" class="btn btn-default btn-xs" value="Remove" onclick="removeRow('. $i .');"></div>';
            }
              
            echo '</div>';
          }
        ?>
    </div>
    <hr>
    <div class="row">  
      <div class="col-md-4 col-md-offset-2">
        {{ Form::submit('Update Authors', array('class' => 'btn btn-success btn-md btn-block')) }}
      </div>
      <div class="col-md-4 col-md-offset-6" style="margin-left:0;">
        {{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-md btn-block'])}}
      </div>
    </div> 
  {{ Form::close() }}
</div>
@stop