<?php  

class ConferenceTopic extends Eloquent {

	protected $table = 'conference_topic';

	protected $fillable = array('conf_id', 'topic_name', 'created_by');
	
	protected $primaryKey = 'topic_id';
	
	public $timestamps = true;


	public  function conference()
	{
		return $this->belongsTo('conference', 'conf_id', 'conf_id');
	}

}