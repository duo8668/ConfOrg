@section('head-content')
  @if($map!='')
        <div>
            <?php echo $map['js']; ?>
        </div>
    @endif
@stop

@extends('layouts.dashboard.master')
@section('page-header')
Showing {{ $venue->Name }}
@stop
@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h2>{{ $venue->Name }}</h2>
        <p>
            <strong>Venue Name:</strong> {{ $venue->Name }}<br>
            <strong>Venue Address:</strong> {{ $venue->Address }}
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