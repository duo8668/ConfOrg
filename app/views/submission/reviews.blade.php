@extends('layouts.dashboard.master')
@section('page-header')
	Reviews for Submission
	{{ link_to_route('submission.index', 'Back to submissions', null, ['class' => 'btn btn-default btn-xs'])}}
@stop
@section('content')
<div class="row">
	  <div class="col-md-2"><strong>Submission Title</strong></div>
	  <div class="col-md-10">{{{ $submission->sub_title }}}</div>
</div>
<div class="row">
  	<div class="col-md-2"><strong>Submission Type</strong></div>
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
				<td><?php echo ( $qlty/$count ); ?></td>
				<td><?php echo ( $ori/$count ); ?></td>
				<td><?php echo ( $relv/$count ); ?></td>
				<td><?php echo ( $sigf/$count ); ?></td>
				<td><?php echo ( $pres/$count ); ?></td>
				<td><strong><?php echo ( (($qlty + $ori + $relv + $sigf + $pres) / ($count * 50)) * 100 ); ?>%</strong></td>
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



@stop