@extends('layouts.dashboard.master')
@section('page-header')
All Equipments
@stop
@section('content')
<!-- BREADCRUMB -->
<ol class="breadcrumb">
  <li><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
  <li class="active">Equipments</li>
</ol>
<hr>

{{ HTML::script('js/filterables.js') }}
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Equipment</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr class="filters">
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Equipment" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Category" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th style="width: 25%;">Option</th>
                    </tr>
                </thead>  
                @foreach($data as $key => $value)
                <tr>
                    <td>{{ $value->equipment_name }}</td> 
                    <td>{{ link_to_route('equipmentcategory.show', $value->equipmentCategory->equipmentcategory_name, ['id' => $value->equipmentCategory->equipmentcategory_id]) }}</td>
                    <td>{{ $value->equipment_status }}</td> 
                    <!-- we will also add show, edit, and delete buttons -->            
                    <td>    
                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        @if($privilege && $value->equipment_status=='Pending')    
                        {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment_id, 'class' => 'inline')) }}                                     
                        {{ Form::submit('Approve Equipment', array('class' => 'btn btn-success btn-xs')) }} 
                        {{ Form::close() }}                
                        @endif
                        @if($privilege)
                        {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'inline')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete Equipment', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}  
                        @endif   
                        @if(!$privilege)
                            @if(is_null($value->pending))
                            <!--send delete request-->
                            {{ Form::open(array('url' => 'equipment/deleterequest/' . $value->equipment_id, 'class' => 'inline')) }}
                                {{ Form::submit('Send Delete Request', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }} 
                            @else <!--pending exist, check if its for a delete request-->
                                @if($value->pending->delete=='false')
                                <!--send delete request-->
                                {{ Form::open(array('url' => 'equipment/deleterequest/' . $value->equipment_id, 'class' => 'inline')) }}
                                    {{ Form::submit('Send Delete Request', array('class' => 'btn btn-danger btn-xs')) }}
                                {{ Form::close() }} 
                                @else
                                <!--cancel delete request-->
                                {{ Form::open(array('url' => 'equipment/deleterequest/' . $value->equipment_id, 'class' => 'inline')) }}
                                    {{ Form::submit('Cancel Delete Request', array('class' => 'btn btn-success btn-xs')) }}
                                {{ Form::close() }} 
                                @endif
                            @endif
                        @endif 
                        <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->                        
                        <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit Equipment</a>                
                    </td>
                </tr>
                @endforeach
            </table> 
        </div> 
    </div>
</div>
<a href="{{ URL::route('equipment.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Equipment</span></a>
@stop