@extends('layouts.dashboard.master')
@section('page-header')
All Equipments
@stop
@section('content')

<!-- will be used to show any messages 
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif-->

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Equipment</td>
            <td>Category</td>                        
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->equipment_name .' - '. $value->equipment_remark }}</td> 
            <td>{{ $value->equipmentcategory_name .' - '. $value->equipmentcategory_remark}}</td>                        
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'equipment/' . $value->equipment_id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this equipment', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('equipment/' . $value->equipment_id) }}">Show this Equipment</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{equipment_id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('equipment/' . $value->equipment_id . '/edit') }}">Edit this Equipment</a>                
            </td>
        </tr>
    @endforeach
@stop