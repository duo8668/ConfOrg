<?php

class SysRole extends Eloquent {
protected $table = 'sysrole';
protected $primaryKey = 'sysrole_id';

protected $fillable = ['user_id','role_id'];
protected $guarded = array('sysrole_id');	
public $timestamps = false;    

    public function user()
    {
        return $this->belongsTo('User');
    }
}