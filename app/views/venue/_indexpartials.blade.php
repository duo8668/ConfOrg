
<div class="row filter-row">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Filter Venues</strong></h3>
            <div class="pull-right">
                <button class="btn btn-primary btn-xs btn-filter"><i class="fa fa-filter"></i> Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">  
                <thead>
                    <tr class="filters">
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Venue Name" disabled></th>
                        <th style="width: 25%;"><input type="text" class="form-control" placeholder="Address" disabled></th>
                        <th style="width: 10%;"><input type="text" class="form-control" placeholder="No. of Room" disabled></th>
                        <th style="width: 10%;"><input type="text" class="form-control" placeholder="Available?" disabled></th>
                        <th>Option</th>
                    </tr>
                </thead>  
            @foreach($venue as $value)
                <tr>
                    <td>{{ link_to_route('venue.show', $value->venue_name, ['id' => $value->venue_id]) }}</td> 
                    <td>{{ $value->venue_address }}</td>            
                    <td>{{ $value->Rooms->count() }}</td>
                    <td>{{ $value->available }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-xs btn-info" href="{{ URL::to('venue/' . $value->venue_id . '/edit') }}">Edit Venue</a>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        @if($value->available=='no')                
                        {{ Form::open(array('url' => 'venue/modify/' . $value->venue_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Make Venue Available', array('class' => 'btn btn-success btn-xs')) }}
                        {{ Form::close() }}
                        @elseif($value->available==='yes')
                        {{ Form::open(array('url' => 'venue/modify/' . $value->venue_id, 'class' => 'inline')) }}                    
                            {{ Form::submit('Make Venue Unavailable', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @endif
                        @if($privilege)
                        {{ Form::open(array('url' => 'venue/' . $value->venue_id, 'class' => 'inline')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this venue', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                        @else  
                            @if(is_null($value->pending))                               
                            {{ Form::open(array('url' => 'venue/deleterequest/' . $value->venue_id, 'class' => 'inline')) }}
                                {{ Form::submit('Send Delete Request', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }} 
                            @else
                            {{ Form::open(array('url' => 'venue/deleterequest/' . $value->venue_id, 'class' => 'inline')) }}
                                {{ Form::submit('Cancel Delete Request', array('class' => 'btn btn-success btn-xs')) }}
                            {{ Form::close() }} 
                            @endif                           
                        @endif

                    </td>
                </tr>
            @endforeach  
            </table> 
        </div> 
    </div>
</div>
<a href="{{ URL::route('venue.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Venue</span></a>