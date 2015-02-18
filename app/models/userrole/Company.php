<?php
class Company extends Eloquent {

	protected $table = 'company';
	protected $primaryKey = 'company_id';

	protected $fillable = array('company_name');
	protected $guarded = array('company_id');

	public $timestamps = false;
}