@extends('layouts.dashboard.master')
@section('page-header')
	Your Profile
@stop

@section('content') 

<div class="row">
  <div class="col-md-12">

		<!-- Name -->
		  <div class="row">
		    <label class="col-md-2 control-label text-right">Name</label>    
		    <div class="col-md-10">
		      {{{ $user->firstname }}} {{{ $user->lastname }}}
		    </div>
		  </div>


		  <!-- Submission Title-->
		  <div class="row">
		    <label class="col-md-2 control-label text-right">Location</label>       
		    <div class="col-md-10">
		      	@if($user->profile->location != '')
					{{{ $user->profile->location }}}
				@else
					Not selected yet.
				@endif
		    </div>
		  </div>

		  <!-- Abstract -->
		  <div class="row">
		    <label class="col-md-2 control-label text-right">Bio</label>
		    <div class="col-md-10">   
		      {{{ $user->profile->bio }}}              
		    </div>
		  </div>

		  <!-- Topics -->
		  <div class="row">
		    <label class="col-md-2 control-label text-right">Email</label> 
		    <div class="col-md-10">
		     {{{ $user->email }}}
		    </div>
		  </div>

		  <!-- Keywords -->
		  <div class="row">
		    <label class="col-md-2 control-label text-right">Facebook</label>    
		    <div class="col-md-10">
			    @if($user->profile->uid > 0)
					<img src="{{{ $user->profile->photo }}}">
					<br><br>{{ link_to('https://www.facebook.com/app_scoped_user_id/'. $user->profile->uid , 'Find me on Facebook!') }}
				@else
					No Facebook account has been associated yet.
				@endif
		    </div>
		  </div>
		  <hr>
		  <div class="row">
		    <label class="col-md-2 control-label text-right"></label>    
		    <div class="col-md-10">
			    @if($user->isCurrent())
				{{ link_to('/users/'.Auth::user()->email .'/edit', 'Edit Your Profile', ['class' => 'btn btn-primary btn-md'])}}
			@endif
		    </div>
		  </div>
	</div>
</div>

	

@stop