<?php
class Submission_Topic extends Eloquent {

	protected $table = 'submission_topic';

	public function submissions()
    {
        return $this->belongsToMany('Submission');
    }
}