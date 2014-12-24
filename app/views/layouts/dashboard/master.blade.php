<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.dashboard.headerdash')
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
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            @yield('content')
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('layouts.dashboard.footerdash')

</body>

</html>
