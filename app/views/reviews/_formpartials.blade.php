<legend>Basic Information</legend>
    <!-- Submission Type -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Submission Type</label>
        <div class="col-md-10">
          @if ($submission->sub_type === 3)
              Poster
          @elseif ($submission->sub_type === 2)
              Full Paper
          @else
              Abstract
          @endif
        </div>
      </div>

      <!-- Submission Title-->
      <div class="row">
        <label class="col-md-2 control-label text-right">Submission Title</label>       
        <div class="col-md-10">
          <strong>{{{ $submission->sub_title }}}</strong>
        </div>
      </div>

      <!-- Abstract -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Abstract</label>
        <div class="col-md-10">   
          {{{ $submission->sub_abstract }}}               
        </div>
      </div>

      <!-- Topics -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Topics</label> 
        <div class="col-md-10">
          @foreach ($sub_topics as $topic) 
            {{{ $topic->topic_name }}}
          @endforeach
        </div>
      </div>

      <!-- Keywords -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Keywords</label>    
        <div class="col-md-10">
          @foreach ($keyword as $word) 
            {{{ $word->keyword_name }}}
          @endforeach
        </div>
      </div>

      <!-- Remarks -->
      <div class="row">
        <label class="col-md-2 control-label text-right">Remarks</label>    
        <div class="col-md-10">
          {{{ $submission->sub_remarks }}}
        </div>
      </div>

      <!-- Upload --> 
      
      <div class="row">
        <label class="col-md-2 control-label text-right">File Upload</label> 
        <div class="col-md-10">
          @if(!empty($submission->attachment_path))
            {{ link_to_asset($submission->attachment_path, 'View File', $attributes = array('target' => '_blank'), $secure = null) }}
          @else
            No File Uploaded
          @endif
        </div>
      </div>
    

    <div style="margin-bottom:40px;"></div>
    
    
      <!-- Button -->
      <legend>Score and Comments</legend>
      <p class="help-block">Please assign scores for each criteris for the current submission. The score must range between 0 to 10.</p>
      <!-- Scores -->
        <div class="form-group @if ($errors->has('quality_score')) has-error @endif">
          {{ Form::label('quality_score', 'Quality *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('quality_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        @if ($errors->has('quality_score')) <p class="help-block">{{ $errors->first('quality_score') }}</p> @endif
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('originality_score')) has-error @endif">
          {{ Form::label('originality_score', 'Originality *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('originality_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        @if ($errors->has('originality_score')) <p class="help-block">{{ $errors->first('originality_score') }}</p> @endif
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('relevance_score')) has-error @endif">
          {{ Form::label('relevance_score', 'Relevance *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('relevance_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        @if ($errors->has('relevance_score')) <p class="help-block">{{ $errors->first('relevance_score') }}</p> @endif
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('significance_score')) has-error @endif">
          {{ Form::label('significance_score', 'Significance *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('significance_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        @if ($errors->has('significance_score')) <p class="help-block">{{ $errors->first('significance_score') }}</p> @endif
        </div>
        <div class="clearfix"></div>

        <div class="form-group @if ($errors->has('presentation_score')) has-error @endif">
          {{ Form::label('presentation_score', 'Presentation *', ['class' => 'col-sm-2 control-label']) }}    
          <div class="col-sm-4">     
            {{ Form::number('presentation_score', null, array('class' => 'input-lg text-center', 'min' => "0", 'max' => "10")) }}
          </div>
        @if ($errors->has('presentation_score')) <p class="help-block">{{ $errors->first('presentation_score') }}</p> @endif
        </div>
        <div class="clearfix"></div>        
      
      <!-- Comments -->
      <div class="form-group @if ($errors->has('comment')) has-error @endif">
        {{ Form::label('comment', 'Your Comment *', ['class' => 'col-sm-2 control-label']) }}    
        <div class="col-sm-10">     
          <p class="help-block">Please clearly and explain your evaluation and/or input in detail and in objective and constructive manner.</p>
        {{ Form::textarea('comment', null, array('class' => 'form-control')) }} 
        @if ($errors->has('comment')) <p class="help-block">{{ $errors->first('comment') }}</p> @endif
        </div>
      </div>
      

      <!-- Internal Comments -->
      <div class="form-group @if ($errors->has('internal_comment')) has-error @endif">
        {{ Form::label('internal_comment', 'Internal Comments', ['class' => 'col-sm-2 control-label']) }}    
        <div class="col-sm-10">     
          <p class="help-block">This comment will not be visible to the authors</p> 
        {{ Form::textarea('internal_comment', null, array('class' => 'form-control')) }} 
        @if ($errors->has('internal_comment')) <p class="help-block">{{ $errors->first('internal_comment') }}</p> @endif
        </div>
      </div>
    </fieldset>
    <hr>