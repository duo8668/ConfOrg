<?php
class Submission extends Eloquent {

	protected $table = 'submissions';
	protected $primaryKey = 'sub_id';
	protected $fillable = array('sub_type', 'sub_title', 'sub_abstract');


    /*public static function boot()
    {
        parent::boot();    
    
        static::deleted(function($submission)
        {
            $submission->reviews()->delete();
            $submission->keywords()->delete();
        });
    } */   

	public function authors()
    {
        return $this->hasMany('Submission_Author', 'sub_id', 'sub_id');
    }

    public function reviews()
    {
        return $this->hasMany('Review', 'sub_id', 'sub_id');
    }

    public function keywords()
    {
        return $this->hasMany('Keyword', 'sub_id', 'sub_id');
    }

    public function topics()
    {
        return $this->hasMany('Submission_Topic');
    }

    public function delete() {
	 
        foreach($this->keywords as $keyword)
        {
            $keyword->delete();
        }

        foreach($this->reviews as $review)
        {
            $review->delete();
        }
        return parent::delete();
	}

}