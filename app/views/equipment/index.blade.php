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

<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:15%"><strong>Equipment</strong></td>
            <td style="width:30%"><strong>Category</strong></td>
            <td style="width:15%"><strong>Status</strong></td>
            <td style="width:40%"><strong>Option</strong></td>
        </tr> 
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->equipment_name }}</td> 
            <td>{{ link_to_route('equipmentcategory.show', $value->equipmentCategory->equipmentcategory_name .' - '. $value->equipmentCategory->equipmentcategory_remark, ['id' => $value->equipmentCategory->equipmentcategory_id]) }}</td>
            <td>{{ $value->equipment_status }}</td> 
            <!-- we will also add show, edit, and delete buttons -->            
            <td>    
                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                @if($privilege==true && $value->equipment_status=='Pending')    
                 {{ Form::open(array('url' => 'equipment/modify/' . $value->equipment_id, 'class' => 'inline')) }}                                     
                    {{ Form::submit('Approve this equipment', array('class' => 'btn btn-success btn-xs')) }} 
                {{ Form::close() }}                
                @endif
                @if($privilege)
                {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this equipment', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                @endif            
                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit this Equipment</a>                
            </td>
        </tr>
    @endforeach
    </table> 
</div> 
<a href="{{ URL::route('equipment.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Equipment</span></a>
@stop