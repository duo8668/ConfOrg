<?php
class Submission_Author extends Eloquent {

	public function submissions()
    {
        return $this->belongsTo('Submission');
    }
}