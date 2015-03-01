<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.dashboard.headerdash')
  @yield('head-content')
</head>

<body>
    <div id="wrapper">

    <!-- Navigation -->
    @include('layouts.dashboard.nav')

    <!-- Sidebar -->
    @include('layouts.dashboard.sidebar')

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">

          <!-- Alert for invalid form inputs, etc -->
          @if (Session::has('message'))
              <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{{ Session::get('message') }}}
              </div>
          @endif    
          
          <!-- Universal form error notification -->
          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  @if(empty($errors->first()) || $errors->first() == '')
                  <p class="text-danger"><Strong> There are some error with the form input !!! </strong></p>
                  @else 
                    <p class="text-danger"><Strong>{{ $errors->first() }}</strong></p>
                  @endif   
              </div>
          @endif       

          <h2 id="page-header" >
            @yield('page-header')
          </h2>

        </div><!-- /.col-lg-12 -->
      </div> <!-- /.row -->

      <!-- Main Content -->
      <div id="displayChannel">
        @yield('content')
      </div>
       @include('layouts.dashboard.footerdash')
   </div><!-- /#page-wrapper -->
 </div><!-- /#wrapper -->

 
</body>
</html>
