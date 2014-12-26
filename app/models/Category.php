<?php

class Category extends Eloquent {	

	public $timestamps = false;	
	protected $primaryKey = 'ID';
	protected $table = 'category';

	protected $fillable = array('Name', 'Remarks');

	public function equipment(){
		return $this->hasMany('Equipment');
	}

	// public function category(){
	// 	return $this->belongsTo('Category', 'categoryID');
	// }
}
