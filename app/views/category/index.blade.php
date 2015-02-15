@extends('layouts.dashboard.master')
@section('page-header')
    All Categories
@stop
@section('content')
<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Category</strong></td>
            <td style="width:25%"><strong>Remarks</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($category as $key => $value)
        <tr>
            <td>{{ $value->Name }}</td> 
            <td>{{ $value->Remarks }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'category/' . $value->ID, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Category', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('category/' . $value->ID) }}">Show this Category</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('category/' . $value->ID . '/edit') }}">Edit this Category</a>
            </td>
        </tr>
    @endforeach
     </table> 
</div> 
@stop