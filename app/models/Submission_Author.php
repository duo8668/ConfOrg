<?php
class Submission_Author extends Eloquent {

	protected $table = 'submission_authors';
	protected $fillable = array('first_name', 'last_name', 'organization', 'email', 'is_presenting');

	public function submissions()
    {
        return $this->belongsTo('Submission');
    }

    public function scopePresenting($query)
    {
        return $query->where('is_presenting', '>', 0);
    }

    public function scopeNotpresenting($query)
    {
        return $query->where('is_presenting', '=', 0);
    }
}
