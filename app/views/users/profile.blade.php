@extends('layouts.dashboard.master')

@section('page-header')
Profile
@stop

@section('content') 

<!--First name, last name -->
<div>
Name : {{$user->firstname}} {{$user->lastname}}  
</div>

<!-- Location -->
<div>
@if($user->profile->location != '')
Location : {{$user->profile->location}}
@else
Location : Not selected yet.
@endif
</div>

<!-- Bio -->
Bio:
<div>
	{{$user->profile->bio}}
</div>

<!-- Email -->
<div>
Email: {{$user->email}}
</div>

<!-- Facebook -->
<div>
Facebook:
@if($user->profile->uid > 0)
	<img src="{{ $user->photo}}">
	{{link_to('https://www.facebook.com/app_scoped_user_id/'.Auth::user()->profile->uid , 'Find me on Facebook!')}}
@else
	No Facebook account has been associated yet.
@endif
</div>

<!-- Edit Profile-->
@if(Auth::user()->id == $user->id)
{{link_to('/users/'.Auth::user()->email .'/edit', 'Edit Your Profile')}}
@endif
@stop