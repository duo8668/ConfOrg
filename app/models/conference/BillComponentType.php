<?php  
class ComponentType extends Eloquent {

	protected $table = 'bill_component_type';

	protected $fillable = array('description', 'is_enabled', 'created_by', 'modified_by');

	protected $guarded = array('billcomponenttype_id');

	public $timestamps = true;

}