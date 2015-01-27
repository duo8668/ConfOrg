<?php
class Submission_Topic extends Eloquent {

	public function submissions()
    {
        return $this->belongsToMany('Submission');
    }
}