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
          <h1 id="page-header" class="page-header">
            @yield('page-header')
          </h1>

        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div id="displayChannel">
       @yield('content')
     </div>        

   </div>
   <!-- /#page-wrapper -->

 </div>
 <!-- /#wrapper -->

 @include('layouts.dashboard.footerdash')

</body>

</html>
