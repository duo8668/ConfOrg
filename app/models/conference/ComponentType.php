<?php  
class ComponentType extends Eloquent {

	protected $table = 'componenttype';

	protected $fillable = array('ComponentType', 'IsEnabled', 'CreatedBy');

	protected $guarded = array('ComponentTypeId', 'DateCreated');

	public $timestamps = false;

}