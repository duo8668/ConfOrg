<?php
class InterestField extends Eloquent {

	protected $table = 'interest_field';
	protected $primaryKey = 'interestfield_id';

	protected $fillable = array('name', 'remarks');

	protected $guarded = array('interestfield_id');

	public $timestamps = false;


}