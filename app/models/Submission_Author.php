<?php
class Submission_Author extends Eloquent {

	protected $table = 'submission_authors';


	public function submissions()
    {
        return $this->belongsTo('Submission');
    }
}
