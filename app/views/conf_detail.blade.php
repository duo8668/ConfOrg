@include ('top')
<style>
    .desc { font-weight:400; margin-bottom:40px;}
</style>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h2 class="text-center" style="color:#fff;">{{{ $conf->title }}}</h2>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <!-- BREADCRUMB -->
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/conference_list') }}" style="color:#777;"><i class="fa fa-arrow-left"></i> Back to Conference List</a></li>
        </ol>
        <hr>
        
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-10" style="padding-left:0; padding-right:0;" >
                    <input type="text" class="form-control" id="search_conf" placeholder="Search conference" >
                </div>
              <button type="submit" class="btn btn-primary col-md-2">Search Conference</button>
            </div>
        </form>
        <hr>
        
        <div class="row">
            <div class="col-md-12" style="margin-bottom:50px;">
               
                <h2 class="text-center"><u>{{{ $conf->title }}}</u></h2>
                <h3 class="text-center">{{ $conf->Room()->Venue()->venue_name }}</h3>
                <h3 class="text-center">{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</h3>

                <!-- SUBMIT PAPER BUTTON  -->
                @if (Auth::check())

                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                        <a href="{{ URL::route('submission.add', ['conf_id' => $conf->conf_id]) }}" class="btn btn-primary btn-block" role="button">Submit Paper</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                        <a href="#" class="btn btn-success btn-block" role="button">Purchase Tickets</a>
                    </div>
                </div>

                @else
                <h5 class="text-center well" style="margin-top:40px;">
                    Please {{ link_to_route('users-sign-in', 'sign in') }} or {{ link_to_route('users-create', 'create an account') }} before submitting papers or purchasing tickets to this conference
                </h5>
                @endif

            </div>

            <div class="col-md-10 col-md-offset-1">
                <legend>About the Conference</legend>
                <p class="desc">
                    {{ $conf->description }}
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
