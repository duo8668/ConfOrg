 <form action = "{{URL::route('admins-invite-resource-post')}}" method = "post">
 	
 	<div class = "field">
 	Resource Provider's Email: <input type ="email" name = "email">
	 	@if($errors->has('email'))
	 		{{ $errors->first('email')	}}
	 	@endif
 	</div>
 	

	<div class = "field">
 	Resource Provider's Company: 
 	{{ Form::select('company', $company_options) }}
	 	@if($errors->has('company'))
	 		{{ $errors->first('company')	}}
	 	@endif
 	</div>

 	<input type="submit" value="Invite!">
 	{{ Form::token() }}
 </form>

<form action = "{{URL::route('admins-add-company-post')}}" method = "post">
 	<div class = "field">
 	Add in new Company: : <input type ="text" name = "new">
	 	
 
 <input type="submit" value="Add!">
 @if($errors->has('new'))
	 		{{ $errors->first('new')	}}
	 	@endif
 	{{ Form::token() }}
 	</div>
</form>
