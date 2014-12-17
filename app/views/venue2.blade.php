@extends('template.thomasDefault')

		@if(Session::has('message'))
			<div class="alert">
			{{ Session::get('message')	}}
			</div>
		@endif

@section('Content')
	Home
@stop
