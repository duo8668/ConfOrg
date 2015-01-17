<?php
class Submission extends Eloquent {

	public function authors()
    {
        return $this->hasMany('Author');
    }

    public function reviews()
    {
        return $this->hasMany('Review', 'sub_id', 'sub_id');
    }
}