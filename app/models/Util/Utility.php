<?php

class Utility extends Eloquent{

	public static function checkPositiveInteger($vale){

		if(is_numeric($vale)){
			if(intval($vale)>0){
				return true;
			}
		}

		return false;
	}

	public static function checkIsAValidDate($myDateString){
		return (bool)strtotime($myDateString);
	}
}