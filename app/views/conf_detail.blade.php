@include ('top')
<style>
    .desc { font-weight:400; margin-bottom:40px;}
</style>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h2 class="text-center" style="color:#fff;">{{{ $conf->conferences->title }}}</h2>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <!-- BREADCRUMB -->
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/conference_list') }}" style="color:#777;"><i class="fa fa-arrow-left"></i> Back to Conference List</a></li>
        </ol>
        <hr>
                
        <div class="row">
            <div class="col-md-12" style="margin-bottom:50px;">
               
                <h2 class="text-center"><u>{{{ $conf->conferences->title }}}</u></h2>
                <h3 class="text-center">{{ $conf->conferences->Room()->Venue()->venue_name }}</h3>
                <h3 class="text-center">{{ date("d F Y",strtotime($conf->conferences->begin_date)) }} to {{ date("d F Y",strtotime($conf->conferences->end_date)) }}</h3>

                <!-- SUBMIT PAPER BUTTON  -->
                <?php 
                    $dt = new DateTime("now"); 
                    $date = $dt->format('Y-m-d H:i:s');
                ?>
                @if (Auth::check())
                    {{-- if conf chair or staff, show edit button  --}}
                    @if (Auth::user()->hasConfRole($conf->conferences->conf_id, 'Conference Chair') || Auth::user()->hasConfRole($conf->conferences->conf_id, 'Conference Staff') || Auth::user()->hasConfRole($conf->conferences->conf_id, 'Reviewer') )
                        <div class="row">
                                <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                                    <a href="{{ URL::to('conference/detail?conf_id=' . $conf->conferences->conf_id) }}" class="btn btn-default btn-block" role="button">Edit Conference Info</a>
                                </div>
                            </div>
                    {{-- otherwise, check if now() > cut_off time --}}
                    @else
                        @if ($date < $conf->conferences->cutoff_time)
                            {{-- else, show submit paper --}}
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                                    <a href="{{ URL::route('submission.add', ['conf_id' => $conf->conferences->conf_id]) }}" class="btn btn-primary btn-block" role="button">Submit Paper</a>
                                </div>
                            </div>
                        @elseif ($date > $conf->conferences->cutoff_time)
                            {{-- if yes, show purchase ticket --}}
                            
                            @if($remaining  < 1)
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                                        {{ Form::button('SOLD OUT', ['type' => 'button', 'class' => '"btn btn-warning btn-block', 'disabled'])}}
                                     </div>
                                </div>
                            @elseif($conf->conferences->ticket_price == 0)
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                                        {{ Form::button('NOT OPEN FOR SALES AT THE MOMENT', ['type' => 'button', 'class' => '"btn btn-warning btn-block', 'disabled'])}}
                                     </div>
                                </div>
                            @else
                            {{ Form::open(['url' => '/conferencePurchaseTicket', 'method' => 'post', 'class' => 'inline' ]) }}
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                                        {{ Form::hidden('conf_id', $conf->conferences->conf_id) }}
                                        {{ Form::hidden('ticket_price', $conf->conferences->ticket_price) }}
                                        {{ Form::button('Purchase Tickets', ['type' => 'submit', 'class' => '"btn btn-success btn-block'])}}
                                     </div>
                                </div>
                            {{ Form::close() }}

                            @endif

                               
                        @else
                            <h5 class="text-center well" style="margin-top:40px;">
                                This conference has been concluded.
                            </h5>
                        @endif
                    @endif

                @else
                     @if ($date < $conf->conferences->end_date)
                        <h5 class="text-center well" style="margin-top:40px;">
                            Please {{ link_to_route('users-sign-in', 'sign in') }} or {{ link_to_route('users-create', 'create an account') }} before submitting papers or purchasing tickets to this conference
                        </h5>
                    @else
                        <h5 class="text-center well" style="margin-top:40px;">
                            This conference has been concluded.
                        </h5>
                    @endif
                @endif

            </div>

            <div class="col-md-10 col-md-offset-1">
                <legend>About the Conference</legend>
                <p class="desc">
                    {{{ $conf->conferences->description }}}
                </p>
                @if (!empty($topics))
                    <legend>Topics</legend>
                    <ol>
                        @foreach ($topics as $topic)
                            <li> {{{ $topic->topic_name }}} </li>
                        @endforeach 
                    </ol>
                    <p class="desc">The paper submitted may cover more than 1 topics.</p>
                @endif
                {{-- <legend>Schedule</legend>
                 <p class="desc">Click here to download the schedule</p> --}}

                 <legend>Contact</legend>
                 <p class="desc">For further enquiry regarding this conference, please contact {{{ $chair->firstname }}} {{{ $chair->lastname }}} at <strong><a href="mailto:{{{ $chair->email }}}">{{{ $chair->email }}}</a>  </strong></p>
            </div>

        </div>
    </div>
  @include('footer')
