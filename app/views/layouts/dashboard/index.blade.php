@extends('layouts.dashboard.master')
@section('page-header')
  Main Dashboard
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li class="active">Dashboard</li>
</ol>
<hr>
{{ HTML::script('js/filterables.js') }}
<!-- 
    NON-RESOURCE PROVIDER VIEW START 
-->
@if ($flag == 'NONRP')
<h4><strong>Your Conferences</strong> <small>(Grouped by your role in the conference)</small></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#participants" aria-controls="participants" role="tab" data-toggle="tab"><strong><i class="fa fa-users"></i> Participants</strong></a></li>
    <li role="presentation"><a href="#reviewer" aria-controls="reviewer" role="tab" data-toggle="tab"><strong><i class="fa fa-graduation-cap"></i> Reviewer</strong></a></li>
    <li role="presentation"><a href="#committee" aria-controls="committee" role="tab" data-toggle="tab"><strong><i class="fa fa-life-ring"></i> Committee Staff</strong></a></li>
    <li role="presentation"><a href="#chair" aria-controls="chair" role="tab" data-toggle="tab"><strong><i class="fa fa-star"></i> Chair</strong></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="participants">
      @if ($p_flag == false)
        <p class="text-center">You are not a participant in any conferences</p>
      @else
        <div class="row filter-row">
          <div class="panel panel-default filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Filter Conference</strong></h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="filters">
                      <th style="width: 40%;"><input type="text" class="form-control" placeholder="Conference Title" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Date" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Location" disabled></th>
                  </tr>
                </thead> 
                
                @foreach ($confs as $conf)
                  @if ($conf->role_id == 8)
                    <tr>
                      <td><a href="{{ URL::to('conference_detail').'/'. $conf->conf_id }}">{{{ $conf->title }}}</a></td>
                      <td>{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</td>
                      <td>{{{ $conf->venue_name }}}</td>
                  </tr> 
                  @endif
                @endforeach
              </table>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div role="tabpanel" class="tab-pane" id="reviewer">
      @if ($r_flag == false)
        <p class="text-center">You are not a reviewer in any conferences</p>
      @else
        <div class="row filter-row">
          <div class="panel panel-default filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Filter Conference</strong></h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="filters">
                      <th style="width: 40%;"><input type="text" class="form-control" placeholder="Conference Title" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Date" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Location" disabled></th>
                  </tr>
                </thead> 
                
                @foreach ($confs as $conf)
                  @if ($conf->role_id == 7)
                    <tr>
                      <td><a href="{{ URL::to('conference/detail?conf_id=' . $conf->conf_id) }}">{{{ $conf->title }}}</a></td>
                      <td>{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</td>
                      <td>{{{ $conf->venue_name }}}</td>
                  </tr> 
                  @endif
                @endforeach
              </table>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div role="tabpanel" class="tab-pane" id="committee">
      @if ($s_flag == false)
        <p class="text-center">You are not a staff committee in any conferences</p>
      @else
        <div class="row filter-row">
          <div class="panel panel-default filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Filter Conference</strong></h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="filters">
                      <th style="width: 40%;"><input type="text" class="form-control" placeholder="Conference Title" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Date" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Location" disabled></th>
                  </tr>
                </thead> 
                
                @foreach ($confs as $conf)
                  @if ($conf->role_id == 5)
                    <tr>
                      <td><a href="{{ URL::to('conference/detail?conf_id=' . $conf->conf_id) }}">{{{ $conf->title }}}</a></td>
                      <td>{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</td>
                      <td>{{{ $conf->venue_name }}}</td>
                  </tr> 
                  @endif
                @endforeach
              </table>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div role="tabpanel" class="tab-pane" id="chair">
      @if ($c_flag == false)
        <p class="text-center">You are not a chairman in any conferences</p>
      @else
        <div class="row filter-row">
          <div class="panel panel-default filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Filter Conference</strong></h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="filters">
                      <th style="width: 40%;"><input type="text" class="form-control" placeholder="Conference Title" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Date" disabled></th>
                      <th style="width: 30%;"><input type="text" class="form-control" placeholder="Location" disabled></th>
                  </tr>
                </thead> 
                
                @foreach ($confs as $conf)
                  @if ($conf->role_id == 4)
                    <tr>
                      <td><a href="{{ URL::to('conference/detail?conf_id=' . $conf->conf_id) }}">{{{ $conf->title }}}</a></td>
                      <td>{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</td>
                      <td>{{{ $conf->venue_name }}}</td>
                  </tr> 
                  @endif
                @endforeach
              </table>
            </div>
          </div>
        </div>
       @endif
    </div>
  </div>

</div>
<hr >
<div class="clearfix"></div>
<div style="margin-bottom:20px;"></div>
<a href="{{ URL::to('conference') }}" class="btn btn-info col-md-3"> See All Conferences</a>

<!-- 
    NON-RESOURCE PROVIDER VIEW END 
-->
@endif
   
<!-- 
    RESOURCE PROVIDER VIEW START 
-->
@if ($flag == 'RP')
<h4><strong>Your Venues</strong></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>
    @include('venue._indexpartials')

<!-- 
    RESOURCE PROVIDER VIEW END 
-->
@endif

<!-- 
    SUPER ADMIN VIEW START 
-->
@if ($flag == 'SA')
<h4><strong>Welcome, Admin</strong></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>

<a href="{{ URL::route('users-invite-friend') }}" class="btn btn-info col-md-3"><i class="fa fa-user-plus fa-fw"></i> Invite a User</a>
<div class="clearfix"></div>
<div style="margin-bottom:20px;"></div>
<a href="{{ URL::route('admins-invite-resource') }}" class="btn btn-info col-md-3"><i class="fa fa-user-plus fa-fw"></i> Invite a Resource Provider</a>

<!-- 
    SUPER ADMIN VIEW END 
-->
@endif
@stop
