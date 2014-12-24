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
                
                @yield('content')
            
            </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('layouts.dashboard.footerdash')

</body>

</html>
