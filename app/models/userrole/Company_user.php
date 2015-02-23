<?php

class CompanyUser extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'company_user_id';
	protected $table = 'company_user';

	protected $fillable = array('user_id', 'company_id');

	public function Company()
	{
		return $this->belongsTo('company', 'company_id');
	}

	public function User()
	{
		return $this->belongsTo('user', 'user_id');
	}
}
