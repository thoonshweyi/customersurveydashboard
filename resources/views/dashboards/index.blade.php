@extends("layouts.adminindex")

@section("content")
     <!-- Start Page Content Area -->
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card shadow py-2 border-left-primarys">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col">
                                        <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Active Branch</h6>
                                        <p id="activebranchcount" class="h5 text-muted mb-0">Loading ....</p>
                                </div>
                                <div class="col-auto">
                                        <i class="fas fa-store fa-2x text-secondary"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card shadow py-2 border-left-primarys">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col">
                                        <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Active User</h6>
                                        <p id="activeusercount" class="h5 text-muted mb-0">Loading ....</p>
                                </div>
                                <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-secondary"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card shadow py-2 border-left-primarys">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col">
                                        <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Total Forms</h6>
                                        <p id="formcount" class="h5 text-muted mb-0">Loading ....</p>
                                </div>
                                <div class="col-auto">
                                        <i class="fas fa-file-alt fa-2x text-secondary"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card shadow py-2 border-left-primarys">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col">
                                        <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Total Contacts</h6>
                                        <p id="contactcount" class="h5 text-muted mb-0">Loading ....</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-address-book fa-2x text-secondary"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>
     <!-- End Page Content Area -->
@endsection

