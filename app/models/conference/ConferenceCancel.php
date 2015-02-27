<?php

class ConferenceCancel extends Eloquent {

    protected $table = 'conference_cancel';
    protected $fillable = array('conf_id', 'created_at', 'created_by');
    protected $guarded = array('conference_cancel_id');
    protected $primaryKey = 'conference_cancel_id';
    public $timestamps = true;

    public function Conference(){
        return $this->belongsTo('Conference','conf_id','conf_id');
    }
}
