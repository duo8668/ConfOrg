<?php
class Author extends Eloquent {

	public function submissions()
    {
        return $this->belongsTo('Submission');
    }
}