<!-- Start Left Navbar -->
<div class="wrappers">
    <nav class="navbar navbar-expand-md navbar-light">

        <button type="button" class="navbar-toggler ms-auto mb-2" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="nav" class="navbar-collapse collapse">
            <div class="container-fluid">

                <div class="row">
                    <!-- Start Left Sidebar -->
                    <div class="col-lg-2 col-md-3 fixed-top vh-100 overflow-auto sidebars">
                        <a href="#" class="navbar-brand d-block bg-white text-white text-center py-3 mx-auto mb-0 borderbottoms">
                            <img src="{{ asset('./assets/imgs/logos/PRO-1-Global-Logo.png') }}" alt="" width="100px%">
                        </a>

                        {{-- <div class="pb-3 borderbottoms">
                            <img src="./assets/img/users/user1.jpg" class="rounded-circle me-3" width="50px" alt="user1"/>
                            <a href="#" class="text-white">Ms.July</a>
                        </div> --}}
                        <ul class="navbar-nav flex-column mt-0">
                            {{-- <li class="nav-item nav-categories">Main</li> --}}
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-md me-3"></i> Dashboard</a></li>
                            {{-- @if(auth()->user()->hasRoles(['Admin','Teacher','Student']))

                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks currents" data-bs-toggle="collapse" data-bs-target="#pagelayout"><i class="fas fa-cloud-download-alt fa-md me-3"></i> Download <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="pagelayout" class="collapse ps-2">
                                        <li><a href="{{route('edulinks.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>  Education</a></li>
                                        <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Software </a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#sidebarlayout"><i class="fas fa-file-alt fa-md me-3"></i> Form<i class="fas fa-angle-left mores"></i></a>
                                    <ul id="sidebarlayout" class="collapse ps-2">
                                        <li><a href="{{route('attendances.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Att Form </a></li>
                                        <li><a href="{{route('leaves.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Leave Form </a></li>
                                        <li><a href="{{route('enrolls.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Enrolls </a></li>

                                    </ul>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-file-alt fa-md me-3"></i> Widgets</a></li>
                            @endif
                            <li class="nav-item nav-categories">UI Features</li>
                            @if(auth()->user()->hasRoles(['Admin','Teacher']))
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#basicui"><i class="fas fa-file-alt fa-md me-3"></i> Articles <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="basicui" class="collapse ps-2">
                                        <li><a href="{{route('posts.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Post </a></li>
                                        <li><a href="{{route('announcements.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Announcement </a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#leaddd"><i class="fas fa-users fa-md me-3"></i> Lead <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="leaddd" class="collapse ps-2">
                                        <li><a href="{{ route('leads.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Leads </a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#advanceui"><i class="fas fa-users fa-md me-3"></i> Students <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="advanceui" class="collapse ps-2">
                                        <li><a href="{{ route('attcodegenerators.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Att Generators </a></li>
                                        <li><a href="{{ route('students.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> All Students </a></li>

                                    </ul>
                                </li>
                            @endif

                            @if(auth()->user()->hasRoles(['Admin','Teacher','Student']))
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#icons"><i class="fas fa-share-alt-square fa-md me-3"></i> Apps <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="icons" class="collapse ps-2">
                                        <li><a href="{{ route('contacts.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Contacts </a></li>
                                        <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Todo </a></li>
                                    </ul>
                                </li>

                                <li class="nav-item"><a href="{{ route('pointtransfers.index') }}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-exchange-alt fa-md me-3"></i> Transfer</a></li>

                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#shipdd"><i class="fas fa-shopping-cart fa-md me-3"></i> Shopping <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="shipdd" class="collapse ps-2">
                                        <li><a href="{{ route('plans.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Plans </a></li>
                                        <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Billing </a></li>
                                        <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Payment </a></li>
                                    </ul>
                                </li>
                            @endif

                            @if(auth()->user()->hasRoles(['Admin','Teacher']))
                                <li class="nav-item nav-categories">Data Representation</li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#chartelement"><i class="fas fa-file-alt fa-md me-3"></i> Fixed Analysis <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="chartelement" class="collapse ps-2">
                                        <li><a href="{{route('countries.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Country</a></li>
                                        <li><a href="{{route('regions.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Region</a></li>
                                        <li><a href="{{route('cities.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> City</a></li>
                                        <li><a href="{{route('townships.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Township</a></li>
                                        <li><a href="{{route('days.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Days</a></li>
                                        <li><a href="{{route('genders.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Gender</a></li>
                                        <li><a href="{{route('religions.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Religion</a></li>
                                        <li><a href="{{route('stages.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Stages</a></li>
                                        <li><a href="{{route('statuses.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right"></i> Status</a></li>

                                    </ul>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#table"><i class="fas fa-file-alt fa-md me-3"></i> Addon <i class="fas fa-angle-left mores"></i></a>
                                    <ul id="table" class="collapse ps-2">
                                        <li><a href="{{route('roleusers.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Assign Roles</a></li>
                                        <li><a href="{{route('permissionroles.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Assign Permissions</a></li>
                                        <li><a href="{{route('categories.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Categories</a></li>
                                        <li><a href="{{route('packages.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Package</a></li>
                                        <li><a href="{{route('paymentmethods.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Payment Method</a></li>
                                        <li><a href="{{route('paymenttypes.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Payment Types</a></li>
                                        <li><a href="{{route('relatives.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Relatives</a></li>
                                        <li><a href="{{route('roles.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Roles</a></li>
                                        <li><a href="{{route('permissions.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Permissions</a></li>
                                        <li><a href="{{route('socialapplications.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Social App</a></li>
                                        <li><a href="{{route('tags.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Tags</a></li>
                                        <li><a href="{{route('types.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Types</a></li>
                                        <li><a href="{{route('warehouses.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Warehouse</a></li>
                                    </ul>
                                </li>
                            @endif --}}


                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks currents" data-bs-toggle="collapse" data-bs-target="#pagelayout"><i class="fas fa-user-cog"></i> System Admin <i class="fas fa-angle-right mores"></i></a>
                                <ul id="pagelayout" class="collapse ps-4">
                                    <li><a href="{{route('users.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>  Users</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Branches </a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Roles </a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Permissions </a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- End Top Sidebar -->

                    <!-- Start Top Sidebar -->
                    @include("layouts.adminnavbar")
                    <!-- End Top Sidebar -->
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- End Left Navbar -->
