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

<!-- 
    NON-RESOURCE PROVIDER VIEW START 
-->
<h4><strong>Your Conferences</strong> <small>(Grouped by your role in the conference)</small></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#participants" aria-controls="participants" role="tab" data-toggle="tab"><strong>Participants</strong></a></li>
    <li role="presentation"><a href="#reviewer" aria-controls="reviewer" role="tab" data-toggle="tab"><strong>Reviewer</strong></a></li>
    <li role="presentation"><a href="#committee" aria-controls="committee" role="tab" data-toggle="tab"><strong>Committee Staff</strong></a></li>
    <li role="presentation"><a href="#chair" aria-controls="chair" role="tab" data-toggle="tab"><strong>Chair</strong></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="participants">
        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
                <td><strong>Conference Title</strong></td>
                <td><strong>Date</strong></td>
                <td><strong>Location</strong></td>
            </tr> 
          </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="reviewer">
        <div class="table-responsive">
          <table class="table table-striped">
           <tr>
                <td><strong>Conference Title</strong></td>
                <td><strong>Date</strong></td>
                <td><strong>Location</strong></td>
            </tr> 
          </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="committee">
        <div class="table-responsive">
          <table class="table table-striped">
           <tr>
                <td><strong>Conference Title</strong></td>
                <td><strong>Date</strong></td>
                <td><strong>Location</strong></td>
            </tr> 
          </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="chair">
        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
                <td><strong>Conference Title</strong></td>
                <td><strong>Date</strong></td>
                <td><strong>Location</strong></td>
            </tr> 
          </table>
        </div>
    </div>
  </div>

</div>

<!-- 
    NON-RESOURCE PROVIDER VIEW END 
-->
   
<!-- 
    RESOURCE PROVIDER VIEW START 
-->
<h4><strong>Your Venues</strong></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>
    @include('venue._indexpartials')

<!-- 
    RESOURCE PROVIDER VIEW END 
-->
@stop
