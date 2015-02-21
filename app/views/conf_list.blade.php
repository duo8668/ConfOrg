@include ('top')
<style>
    .desc { font-weight:400;}
    .ellipsis { overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
</style>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h1 class="text-center" style="color:#fff;">All Conferences</h1>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        @if (Session::has('message'))
              <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{{ Session::get('message') }}}
              </div>
          @endif   
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
             @foreach ($confs as $conf)
                <div class="col-md-4 portfolio-item">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h4>
                            {{ link_to_route( 'conference.public_detail', $conf->title, ['id' => $conf->conf_id] ) }}
                        </h4>    
                        <p class="desc">{{ $out = strlen($conf->description) > 70 ? substr($conf->description,0,70)."..." : $conf->description }}</p>
                        <p class="desc">{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</p>
                        <p class="desc">[[ VENUE HERE ]]</p>
                        {{ link_to_route( 'conference.public_detail', 'More Info', ['id' => $conf->conf_id], ['class' => 'btn btn-info btn-md pull-right'] ) }}
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

  @include('footer')
