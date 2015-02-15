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
<hr>
	<div class="table-responsive">
	  <table class="table">
	    <tr class="active text-center">
			<td>Quality</td>
			<td>Originality</td>
			<td>Relevance</td>
			<td>Significance</td>
			<td>Presentation</td>
			<td><strong>Overall Recommendation</strong></td>
		</tr>
		<tr class="success text-center">
			<?php 
				$qlty = 0;
				$ori = 0;
				$relv = 0;
				$sigf = 0;
				$pres = 0;
				$recm = 0;
				$count = 0;

				foreach ($reviews as $rev) {
					$qlty += $rev->quality_score;
					$ori += $rev->originality_score;
					$relv += $rev->relevance_score;
					$sigf += $rev->significance_score;
					$pres += $rev->presentation_score;
					$count++;
				}
			?>
			@if ($count > 0)
				<td><?php echo ( number_format($qlty/$count,2) ); ?></td>
				<td><?php echo ( number_format($ori/$count,2) ); ?></td>
				<td><?php echo ( number_format($relv/$count,2) ); ?></td>
				<td><?php echo ( number_format($sigf/$count,2) ); ?></td>
				<td><?php echo ( number_format($pres/$count,2) ); ?></td>
				<td><strong><?php echo ( number_format((($qlty + $ori + $relv + $sigf + $pres) / ($count * 50)) * 100,2) ); ?>%</strong></td>
			@else
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td><strong>0%</strong></td>
			@endif
		</tr>
	  </table>
	</div>
<div class="row">
  <div class="col-md-12"><strong>Comments and approval rating</strong>
  	@if ($count > 0)
		@foreach ($reviews as $rev)
			<hr>
			<div class="row">
				<div class="col-md-1"><h1 style="margin-top:0;" class="text-center">{{{ (($rev->quality_score + $rev->originality_score + $rev->relevance_score + $rev->significance_score + $rev->presentation_score) / 50) * 100 }}}% </h1></div>
				<div class="col-md-11">{{{ $rev->comment }}}</div>
			</div>
		@endforeach
	@else 
	  	<br />No comments yet
	@endif
  </div>
</div>
