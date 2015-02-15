@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop

@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $venue->venue_name }}
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li><a href="{{ URL::route('venue.index') }}">Venues</a></li>
  <li class="active">{{{ $venue->venue_name }}}</li>
</ol>
<hr>

<div class="container">
    <div class="jumbotron text-center">
        <h2>{{ $venue->venue_name }}</h2>
        <p>
            <strong>Venue Name:</strong> {{ $venue->venue_name }}<br>
            <strong>Venue Address:</strong> {{ $venue->venue_address }}
        </p>
    </div>        
    @if($map!='')
        <center>
            <div style="max-width:900px">
                    <?php echo $map['html']; ?> 
            </div>
        </center>
    @endif
    
</div>
@stop