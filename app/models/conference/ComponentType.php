<?php
class ComponentType extends Eloquent {

	protected $table = 'componenttype';

	protected $fillable = array('IsEnabled', 'CreatedBy', 'DateCreate');

	public $timestamps = false;

}