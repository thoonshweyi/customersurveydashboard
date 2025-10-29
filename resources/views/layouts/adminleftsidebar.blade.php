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
                        <a href="{{ route("dashboards.index") }}" class="navbar-brand d-block bg-white text-white text-center py-3 mx-auto mb-0 borderbottoms">
                            <img src="{{ asset('./assets/imgs/logos/PRO-1-Global-Logo.png') }}" alt="" width="100px%">
                        </a>

                        {{-- <div class="pb-3 borderbottoms">
                            <img src="./assets/img/users/user1.jpg" class="rounded-circle me-3" width="50px" alt="user1"/>
                            <a href="#" class="text-white">Ms.July</a>
                        </div> --}}
                        <ul class="navbar-nav flex-column mt-0">
                            {{-- <li class="nav-item nav-categories">Main</li> --}}
                            <li class="nav-item"><a href="{{ route("dashboards.index") }}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-md me-3"></i> Dashboard</a></li>


                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks currents" data-bs-toggle="collapse" data-bs-target="#customermanagement"><i class="fas fa-users"></i> Survey Management <i class="fas fa-angle-right mores"></i></a>
                                <ul id="customermanagement" class="collapse ps-4">
                                    @can('create',App\Models\Form::class)
                                    <li><a href="{{route('forms.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>  Form</a></li>
                                    @endcan
                                </ul>
                            </li>


                            @can('view',App\Models\Resource::class)
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#pagelayout"><i class="fas fa-user-cog"></i> System Management <i class="fas fa-angle-right mores"></i></a>
                                <ul id="pagelayout" class="collapse ps-4">
                                    <li><a href="{{route('users.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>  Users</a></li>
                                    <li><a href="{{ route("branches.index") }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Branches </a></li>
                                    <li><a href="{{ route('roles.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Roles </a></li>
                                    <li><a href="{{ route('permissions.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Permissions </a></li>
                                    <li><a href="{{ route('permissionroles.index') }}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Permission Roles </a></li>
                                </ul>
                            </li>
                            @endcan



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
