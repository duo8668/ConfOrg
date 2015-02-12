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
                        <li class="sidebar-divider"></li>

                        <!-- USER COMMON SETTINGS -->
                        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Main Dashboard</a></li>
                        <li><a href="{{URL::route('users-profile', ['email' => Auth::user()->email])}}"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- PARTICIPANT SETTINGS, appear when user == participant -->
                        <li><a href="#"><i class="fa fa-cc-paypal fa-fw"></i> Make Payment</a></li>
                        <li><a href="#"><i class="fa fa-ticket fa-fw"></i> Invoice & Confirmation</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o fa-fw"></i> Contact Conference Staff</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- SUBMISSION LINKS, appear when viewing conference currently calling for papers -->
                        <li><a href="{{ URL::route('submission.index') }}"><i class="fa fa-file fa-fw"></i> Your Submissions</a></li>
                        <li><a href="{{ URL::route('submission.create') }}"><i class="fa fa-plus fa-fw"></i> New Submission</a></li>
                        <li class="sidebar-divider"></li>


                        <!-- REVIEW LINKS, appear if user == reviewers -->
                        <li><a href="{{ URL::route('reviews.index') }}"><i class="fa fa-comment fa-fw"></i> Enter/Edit Reviews</a>
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
                        <li><a href="#"><i class="fa fa-map-marker fa-fw"></i> Venue<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ URL::route('venue.index') }}">My Venues</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('venue.create') }}">Add New Venue</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('equipmentcategory.index') }}">Category</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('equipment.index') }}">Equipment</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('room.index') }}">Room</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                     
                        <li><a href="#"><i class="fa fa-cutlery fa-fw"></i>Food</a></li>   
                        <li><a href="#"><i class="fa fa-smile-o fa-fw"></i>Entertainment</a></li>
                         <li class="sidebar-divider"></li>

                        <!-- END OF SIDEBAR MENU -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>