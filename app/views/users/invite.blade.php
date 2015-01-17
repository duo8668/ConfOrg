 <form action = "{{URL::route('users-invite-friend-post')}}" method = "post">
 	
 	<div class = "field">
 	Friend's Email: <input type ="email" name = "email">
	 	@if($errors->has('email'))
	 		{{ $errors->first('email')	}}
	 	@endif
 	</div>
 	
	<div class = "field">
 	Friend's First Name: <input type ="text" name = "firstname">
	 	@if($errors->has('firstname'))
	 		{{ $errors->first('firstname')	}}
	 	@endif
 	</div>

	<div class = "field">
 	Friend's Last Name: <input type ="text" name = "lastname">
	 	@if($errors->has('lastname'))
	 		{{ $errors->first('lastname')	}}
	 	@endif
 	</div>

 	<input type="submit" value="Invite!">
 	{{ Form::token() }}
 </form>
