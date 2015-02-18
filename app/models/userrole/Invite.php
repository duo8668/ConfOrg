<?php
class Invite extends Eloquent {

	protected $table = 'invitation';
	protected $primaryKey = 'invite_id';

	protected $fillable = array('code','email','company');
	protected $guarded = array('invite_id');

	public $timestamps = false;
}