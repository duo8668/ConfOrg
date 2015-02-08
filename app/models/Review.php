<?php
class Review extends Eloquent {

	protected $table = 'reviews';
	protected $primaryKey = 'review_id';
	protected $fillable = array('quality_score', 'relevance_score', 'originality_score', 'significance_score', 'presentation_score', 'user_id');

	public function submissions()
    {
        return $this->belongsTo('Submission');
    }
}