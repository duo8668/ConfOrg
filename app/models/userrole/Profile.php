<?php

class Profile extends Eloquent {
protected $table = 'profiles';
protected $primaryKey = 'profile_id';

protected $fillable = ['user_id','uid','access_token','fb_email','created_at','updated_at','bio','location'];
protected $guarded = array('profile_id');	
    
    public function user()
    {
        return $this->belongsTo('User');
    }
}