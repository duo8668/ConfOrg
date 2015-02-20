@include ('top')
<style>
    .desc { font-weight:400;}
</style>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h1 class="text-center" style="color:#fff;">All Conferences</h1>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="email" class="form-control" id="search_conf" placeholder="Search conference" >
                </div>
              <button type="submit" class="btn btn-primary col-md-2">Search Conference</button>
            </div>
        </form>
        <hr>
        <div class="row">
            <div class="col-md-4 portfolio-item">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>
                        <a href="#">Project Name</a>
                    </h4>    
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <p class="desc">20 - 25 May 2015</p>
                    <p class="desc">Singapore Expo</p>
                    <a href="#" class="btn btn-info btn-md pull-right" role="button">More Info</a>
                  </div>
                </div>
            </div>

            <div class="col-md-4 portfolio-item">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>
                        <a href="#">Project Name</a>
                    </h4>     
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <p class="desc">20 - 25 May 2015</p>
                    <p class="desc">Singapore Expo</p>
                    <a href="#" class="btn btn-info btn-md pull-right" role="button">More Info</a>
                  </div>
                </div>
            </div>

           <div class="col-md-4 portfolio-item">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>
                        <a href="#">Project Name</a>
                    </h4>   
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <p class="desc">20 - 25 May 2015</p>
                    <p class="desc">Singapore Expo</p>
                    <a href="#" class="btn btn-info btn-md pull-right" role="button">More Info</a>
                  </div>
                </div>
            </div>

            <div class="col-md-4 portfolio-item">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>
                        <a href="#">Project Name</a>
                    </h4>   
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <p class="desc">20 - 25 May 2015</p>
                    <p class="desc">Singapore Expo</p>
                    <a href="#" class="btn btn-info btn-md pull-right" role="button">More Info</a>
                  </div>
                </div>
            </div>

        </div>
    </div>

  @include('footer')
