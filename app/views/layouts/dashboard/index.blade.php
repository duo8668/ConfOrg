@extends('layouts.dashboard.master')
@section('page-header')
  Main Dashboard
@stop
@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-info">
            <div class="panel-heading">
            	<strong>All Conferences</strong>
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr>
                        <td>ALIA Conference 2015</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>27th Humanities and Social Science Symposium</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>International Conference on Artificial Intelligence and Applications (AIFU 2015)</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>International Conference on Networks Communications (NCOM - 2015)</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>International Conference on Signal and Image Processing (SIGPRO 2015)</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>Fifth International conference on Computer Science and Information Technology (CCSIT - 2015)</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                    <tr>
                        <td>International Conference on Data Mining (DTMN 2015)</td>
                        <td>26 - 27 November 2015</td>
                        <td>Melbourne, Australia</td>
                    </tr>
                </tbody>
            </table>             
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
            	Newly Added Venues
            </div>
             <table class="table table-striped">                                    
                <tbody>
                    <tr><td>Marina Bay Sands</td></tr>
                    <tr><td>Suntec Convention Center</td></tr>
                    <tr><td>Expo Singapore</td></tr>
                    <tr><td>St Regis Hotel</td></tr>
                    <tr><td>Nanyang Auditorium at Nanyang Technological University</td></tr>
                </tbody>
            </table>   
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>
	</div><!-- /.col-lg-6 (nested) -->

	<div class="col-lg-4">
		<div class="panel panel-primary">
            <div class="panel-heading">
            	Conferences in which you are a <strong>Participant</strong> 
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td>ALIA Conference 2015</td></tr>
                    <tr><td>27th Humanities and Social Science Symposium</td></tr>
                </tbody>
            </table>   
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
            	Conferences in which you are a <strong>Reviewer</strong> 
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td style="width:75%;">International Conference on Artificial Intelligence and Applications (AIFU 2015)</td>
                        <td class="small-12px">Go to Dashboard</td></tr>
                </tbody>
            </table>   
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
            	Conferences in which you are a <strong>Chair</strong> 
            </div>
            <table class="table table-striped">                                    
                <tbody>
                    <tr><td style="width:75%;">International Conference on Data Mining (DTMN 2015)</td>
                        <td class="small-12px">Go to Dashboard</td></tr>
                </tbody>
            </table>   
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
            	Conferences in which you are a <strong>Staff</strong> 
            </div>
            <table class="table table-striped">                                    
                <tbody>                    
                    <tr><td style="width:75%;">International Conference on Networks Communications (NCOM - 2015)</td>
                        <td class="small-12px">Go to Dashboard</td></tr>              
                </tbody>
            </table>   
            <div class="panel-footer">
                <span class="pull-right">View More  <i class="fa fa-arrow-circle-right"></i></span>    
                <div class="clearfix"></div>        
            </div>
        </div>
	</div><!-- /.col-lg-6 (nested) -->
</div>
@stop
