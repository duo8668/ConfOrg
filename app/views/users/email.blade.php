 <form action = "{{URL::route('users-request-email-post')}}" method = "post">
 	<div class = "field">
 	Old Email: {{ Auth::user()->email}}
 	</div>
 	<div class = "field">
 	New Email: <input type ="email" name = "new_email">
	 	@if($errors->has('new_email'))
	 		{{ $errors->first('new_email')	}}
	 	@endif
 	</div>
 	
 	<input type="submit" value="Change Email">
 	{{ Form::token() }}
 </form>
 
@if(Session::has('global'))
    {{Session::get('global')}} 
@endif