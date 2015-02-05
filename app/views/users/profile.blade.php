@extends('layouts.dashboard.master')

@section('page-header')
Profile
@stop

@section('content') 

<!--First name, last name -->
<div>
Name : <pre>{{$user->firstname}} {{$user->lastname}}</pre> 
</div>

<!-- Location -->
<div>
@if($user->profile->location != '')
Location : <pre>{{$user->profile->location}}</pre>
@else
Location :<pre>Not selected yet.</pre>
@endif
</div>

<!-- Bio -->
Bio:
<div>
<pre>{{$user->profile->bio}}</pre>
	
</div>

<!-- Email -->
<div>
Email: <pre>{{$user->email}}</pre>
</div>

<!-- Facebook -->
<div>
Facebook:
@if($user->profile->uid > 0)
	<img src="{{ $user->profile->photo}}">
	<br><br>{{link_to('https://www.facebook.com/app_scoped_user_id/'. $user->profile->uid , 'Find me on Facebook!')}}
@else
	<pre>No Facebook account has been associated yet.</pre>
@endif
</div>

<!-- Edit Profile-->
@if($user->isCurrent())
	{{link_to('/users/'.Auth::user()->email .'/edit', 'Edit Your Profile')}}
@endif
@stop