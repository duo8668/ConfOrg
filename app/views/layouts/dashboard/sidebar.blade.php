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
                        <li>                            
                            <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file fa-fw"></i> Submission <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('submission') }}">All Submission</a>
                                </li>
                                <li>
                                    <a href="{{ url('submission/create') }}">Add New Submission</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('review') }}"><i class="fa fa-comment fa-fw"></i> Enter/Edit Reviews</a>     
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Users & Roles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Review Panels</a>
                                </li>
                                <li>
                                    <a href="#">Conference Staff</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Conference Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"> Conference Schedule</a>
                                </li>
                                <li>
                                    <a href="#"> Conference Participants</a>
                                </li>
                                <li>
                                    <a href="#"> Conference Info</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building fa-fw"></i> Venue Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"></i> Equipments <span class="fa arrow"></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Add New Equipments</a>
                                        </li>   
                                        <li>
                                            <a href="#">View All Equipments</a>
                                        </li>                                      
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"></i> Category <span class="fa arrow"></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ url('category/create') }}">Add New Category</a>
                                        </li>    
                                        <li>
                                            <a href="{{ url('category') }}">View All Category</a>
                                        </li>                                     
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"></i> Venue <span class="fa arrow"></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ url('venue/create') }}">Add New Venue</a>
                                        </li>     
                                        <li>
                                            <a href="{{ url('venue') }}">View All Venue</a>
                                        </li>                                    
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"> Room <span class="fa arrow"></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Add New Room</a>
                                        </li>   
                                        <li>
                                            <a href="#">View All Room</a>
                                        </li>                                      
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		<!-- ----------- SIDEBAR END ----------- -->