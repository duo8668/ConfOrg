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
                        <span class="fa fa-4x fa-check-circle"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Features You Need</h4>
                        <p>ORAFER comes packed with all the features you need to organize a conference: double-blind peer-review, registration and online payment and special features where you can book venues for your conference. All in one place.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-mobile"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">Mobile Friendly</h4>
                        <p>The responsive design will ensure our users to be able to access ORAFER anywhere, anytime, from any kind of devices.</p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-icon">
                        <span class="fa fa-4x fa-support"></span>
                    </div>
                    <div class="info">
                        <h4 class="text-center">All Year Round Support</h4>
                        <p>We put a ton of effort into providing top-notch tech support to all of our users. With our dedicated support staff, you can have a smooth expeience in organizing your conference with ORAFER. </p>
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