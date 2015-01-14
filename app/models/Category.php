<?php

class Category extends Eloquent {	

	public $timestamps = false;	
	protected $primaryKey = 'category_id';
	protected $table = 'category';

	protected $fillable = array('category_name', 'category_remark');

	public function equipments(){
		return $this->hasmany('Equipment', 'category_id','category_id');
	}

	// public function category(){
	// 	return $this->belongsTo('Category', 'categoryID');
	// }
}
