<!-- ----------- SIDEBAR START ----------- -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <!-- USER COMMON SETTINGS -->
                        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Main Dashboard</a></li>
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- PARTICIPANT SETTINGS, appear when user == participant -->
                        <li><a href="#"><i class="fa fa-cc-paypal fa-fw"></i> Make Payment</a></li>
                        <li><a href="#"><i class="fa fa-ticket fa-fw"></i> Invoice & Confirmation</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o fa-fw"></i> Contact Conference Staff</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- SUBMISSION LINKS, appear when viewing conference currently calling for papers -->
                        <li><a href="{{ url('submission') }}"><i class="fa fa-file fa-fw"></i> All Submission</a></li>
                        <li><a href="{{ url('submission/create') }}"><i class="fa fa-plus fa-fw"></i> Add New Submission</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- REVIEW LINKS, appear if user == reviewers -->
                        <li><a href="{{ url('review') }}"><i class="fa fa-comment fa-fw"></i> Enter/Edit Reviews</a>
                        </li>
                        <li class="sidebar-divider"></li>


                        <!-- CONFERENCE MANAGEMENT LINKS, appear if user == Chairman || user == Staff -->
                        <li><a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Conference Reviewers</a></li>
                        <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Conference Staff</a></li>
                        <li><a href="#"><i class="fa fa-calendar fa-fw"></i> Conference Schedule</a></li>
                        <li><a href="#"><i class="fa fa-group fa-fw"></i> Conference Participants</a></li>
                        <li><a href="{{ url('conference') }}"><i class="fa fa-pencil-square-o fa-fw"></i> Edit Conference</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- VENUE MANAGEMENT LINKS, appear if user == Provider/Facilitator -->
                        <li><a href="{{ url('equipment/create') }}">Add Equipments</a></li>   
                        <li><a href="{{ url('equipment') }}">All Equipments</a></li>
                        <li><a href="{{ url('category/create') }}">Add Category</a></li>    
                        <li><a href="{{ url('category') }}">All Category</a></li>
                        <li><a href="{{ url('venue/create') }}">Add Venue</a></li>     
                        <li><a href="{{ url('venue') }}">All Venue</a></li>                       
                        <li><a href="{{ url('room/create') }}">Add Room</a></li>   
                        <li><a href="{{ url('room') }}">All Room</a></li>
                         <li class="sidebar-divider"></li>

                        <!-- END OF SIDEBAR MENU -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>