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
    <!-- <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-ticket fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Participant</h3>
                    </div>
                </div>
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td>ALIA Conference 2015</td></tr>
                    <tr><td>27th Humanities and Social Science Symposium</td></tr>
                </tbody>
            </table> 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Reviewer</h3>
                    </div>
                </div>
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td>International Conference on Artificial Intelligence and Applications (AIFU 2015)</td>
                        </tr>
                </tbody>
            </table> 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Staff</h3>
                    </div>
                </div>
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td>International Conference on Data Mining (DTMN 2015)</td>
                </tbody>
            </table> 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-star fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3>Chairman</h3>
                    </div>
                </div>
            </div>
            <table class="table table-striped">                                    
                <tbody>                    
                    <tr><td>International Conference on Networks Communications (NCOM - 2015)</td>
                </tbody>
            </table> 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div> -->

<!-- 
    RESOURCE PROVIDER VIEW START 
-->
<h4><strong>Your Venues</strong></h4>
<div style="margin-bottom:20px;"></div>
<div class="clearfix"></div>
    [INCLUDE venue._indexpartials here]

<!-- 
    RESOURCE PROVIDER VIEW END 
-->
@stop
