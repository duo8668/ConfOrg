<?php

class ProfileController extends BaseController{

	public function user($user_id){
		$user = User::where('user_id', '=', $user_id);
		if($user->count()){
			$user = $user->first();
			return View::make('users.profile')
				->with('user',$user);
		}
		return App::abort(404);
		
	}
}