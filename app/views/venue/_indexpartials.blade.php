<div class="table-responsive">
    <table class="table">   
        <tr>
            <td style="width:25%"><strong>Venue Name</strong></td>
            <td style="width:25%"><strong>Address</strong></td>
            <td style="width:50%"><strong>Option</strong></td>
        </tr> 
    @foreach($venue as $key => $value)
        <tr>
            <td>{{ link_to_route('venue.show', $value->venue_name, ['id' => $value->venue_id]) }}</td> 
            <td>{{ $value->venue_address }}</td>            

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-xs btn-info" href="{{ URL::to('venue/' . $value->venue_id . '/edit') }}">Edit Venue</a>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'venue/' . $value->venue_id, 'class' => 'inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Venue', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}

                <button class="btn btn-xs btn-info" onclick="$('#{{$value->venue_id}}').toggle();">Show/Hide</button>
                <div id="{{$value->venue_id}}" style="display:none">  
                    Hide show.....
                </div>

            </td>
        </tr>
    @endforeach  
    </table> 
</div> 
<a href="{{ URL::route('venue.create') }}" class="btn btn-info btn-sm"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Add Venue</span></a>