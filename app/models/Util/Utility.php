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

	public static function js_array($array)
	{
		$temp = array_map('js_str', $array);
		return '[' . implode(',', $temp) . ']';
	}

	public static function in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }

	    return false;
	}
}