<?php
class Keyword extends Eloquent {

	public function submissions()
    {
        return $this->belongsToMany('Submission');
    }
}