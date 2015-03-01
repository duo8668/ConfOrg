<?php 

class ConferenceField extends Eloquent {

	protected $table = 'conference_field';
	
	protected $fillable = array('conf_id','interestfield_id','created_by','modified_by');

	protected $guarded = array('conferencefield_id');
	
	public $timestamps = false;
	
	public function InterestField()
	{
		return $this->hasOne('InterestField','interestfield_id','interestfield_id');
	}
}