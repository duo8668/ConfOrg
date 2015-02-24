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
                        <li><a href="{{ URL::route('users.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Main Dashboard</a></li>
                        <li><a href="{{ URL::route('users-profile', ['profile' => Auth::user()->email]) }}"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                                                
                        @if (Auth::user()->hasSysRole('Resource Provider'))

                            <li><a href="{{ URL::route('venue.index') }}"><i class="fa fa-map-marker fa-fw"></i> Venue</a></li>
                            <li><a href="{{ URL::route('equipmentcategory.index') }}"><i class="fa fa-sitemap fa-fw"></i> Category</a></li>
                            <li><a href="{{ URL::route('equipment.index') }}"><i class="fa fa-cogs fa-fw"></i> Equipment</a></li>
                            <li><a href="{{ URL::route('room.index') }}"><i class="fa fa-location-arrow fa-fw"></i> Room</a></li>     
                            <li><a href="{{ URL::to('/import') }}"><i class="fa fa-upload fa-fw"></i> Import</a></li> 

                        @elseif (Auth::user()->hasSysRole('Admin'))

                            <li><a href="{{ URL::route('venue.index') }}"><i class="fa fa-map-marker fa-fw"></i> Venue</a></li>
                            <li><a href="{{ URL::route('equipmentcategory.index') }}"><i class="fa fa-sitemap fa-fw"></i> Category</a></li>
                            <li><a href="{{ URL::route('equipment.index') }}"><i class="fa fa-cogs fa-fw"></i> Equipment</a></li>
                            <li><a href="{{ URL::route('room.index') }}"><i class="fa fa-location-arrow fa-fw"></i> Room</a></li>     
                            <li><a href="{{ URL::to('/import') }}"><i class="fa fa-upload fa-fw"></i> Import</a></li>  
                            <li><a href="{{ URL::route('invoice.index') }}"><i class="fa fa-ticket fa-fw"></i> Invoices </a></li>
                            <li><a href="{{ URL::route('users-invite-friend') }}"><i class="fa fa-user-plus fa-fw"></i> Invite a Friend</a></li>
                            <li><a href="{{ URL::route('admins-invite-resource') }}"><i class="fa fa-user-plus fa-fw"></i> Invite a Resource Provider</a></li> 

                        @else 

                            <li><a href="{{ URL::route('invoice.index') }}"><i class="fa fa-ticket fa-fw"></i> Invoice & Payment</a></li>
                            <li><a href="{{ URL::route('submission.index') }}"><i class="fa fa-file fa-fw"></i> Your Submissions</a></li>
                            <li><a href="{{ URL::route('reviews.index') }}"><i class="fa fa-comment fa-fw"></i> Your Reviews</a>
                            </li>
                            <li><a href="{{ URL::route('users-invite-friend') }}"><i class="fa fa-user-plus fa-fw"></i> Invite a Friend</a></li>
                                                    
                         @endif

                        <!-- END OF SIDEBAR MENU -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>