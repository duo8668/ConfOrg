<?php
class Review extends Eloquent {

	public function submissions()
    {
        return $this->belongsTo('Submission');
    }
}