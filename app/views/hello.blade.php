@include ('top');

    <!-- Header -->
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Welcome to ORAFER</h1>
                        <h3>A solution for easy organization of Conference</h3>
                        <hr class="intro-divider">                   
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
    <div id="features"></div>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-html5"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Title</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-group"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Easy Access</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-css3"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Title</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Get started right now!</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="{{ URL::route('users-sign-in') }}" class="btn btn-default btn-lg"><span class="network-name"><i class="fa fa-user fa-fw"></i> Sign in</span></a>
                        </li>
                        <li>
                            <a href="{{ URL::route('users-create') }}" class="btn btn-info btn-lg"> <span class="network-name"> <i class="fa fa-plus fa-fw"></i> Sign up</span></a>
                        </li>                
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </div>
    <!-- /.banner -->

   @include('footer')