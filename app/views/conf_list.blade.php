@include ('top')
<style>
    .desc { font-weight:400;}
    .ellipsis { overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
</style>
{{ HTML::script('js/searchable-ie.js') }}
<script type="text/javascript">
$(function () {
    // $( '#table' ).searchable({
    //     striped: true,
    //     oddRow: { 'background-color': '#f5f5f5' },
    //     evenRow: { 'background-color': '#fff' },
    //     searchType: 'fuzzy'
    // });
    
    $( '#searchable-container' ).searchable({
        searchField: '#container-search',
        selector: '.row',
        childSelector: '.target',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })
});
</script>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h1 class="text-center" style="color:#fff;">All Conferences</h1>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" id="searchable-container" style="margin-top: 50px; margin-bottom: 50px;">
        @if (Session::has('message'))
              <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{{ Session::get('message') }}}
              </div>
          @endif   
        
        <div class="col-md-12" style="padding-left:0; padding-right:0; margin-bottom:30px" >
            <input type="search" id="container-search" value="" class="form-control" placeholder="Search Conferences..." autofocus>
        </div>
        
        <hr>
        <div class="clearfix"></div>
        <div class="row">
             @foreach ($confs as $conf)
                <div class="col-md-4 portfolio-item">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h4 class="conf_title">
                            {{ link_to_route( 'conference.public_detail', $conf->title, ['id' => $conf->conf_id] ) }}
                        </h4>    
                        <p class="desc">{{ $out = strlen($conf->description) > 70 ? substr($conf->description,0,70)."..." : $conf->description }}</p>
                        <p class="desc">{{ date("d F Y",strtotime($conf->begin_date)) }} to {{ date("d F Y",strtotime($conf->end_date)) }}</p>
                        <p class="desc">{{ $conf->Room()->Venue()->venue_name }}</p>
                        {{ link_to_route( 'conference.public_detail', 'More Info', ['id' => $conf->conf_id], ['class' => 'btn btn-info btn-md pull-right'] ) }}
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

  @include('footer')
