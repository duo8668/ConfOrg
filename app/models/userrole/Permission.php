<?php
class Permission extends Eloquent {

	protected $table = 'permissions';
	protected $primaryKey = 'permission_id';

	protected $fillable = array('permission_name', 'permission_remarks');
	protected $guarded = array('permission_id');

	public $timestamps = false;

	public function scopeFinanceEdit(){
		return $this->where('permission_name','=','finance-edit')->first();
	}


}