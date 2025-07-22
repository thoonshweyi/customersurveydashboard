@extends("layouts.adminindex")

@section("caption","Country List")
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
                                    <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Survey Branch</h6>
                                    <p id="responsebranchcount" class="h5 text-muted mb-0">Loading ....</p>
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
                                    <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">Total Responses</h6>
                                    <p id="responsecount" class="h5 text-muted mb-0">Loading ....</p>
                            </div>
                            <div class="col-auto">
                                    <i class="fas fa-comment-dots fa-2x text-secondary"></i>
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
                                    <h6 class="text-xs fw-bold text-primary text-uppercase mb-1">With Contact Info</h6>
                                    <p id="contactresponsecount" class="h5 text-muted mb-0">Loading ....</p>
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

          <div class="col-md-12">

               <form action="" method="">
                    <div class="row justify-content-end">
                         <div class="col-md-2 col-sm-6 mb-2">
                              <div class="input-group">
                                   <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search...."/>
                                   <button type="submit" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>

          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Survey Responses By Branch</h4>
                </div>
                <div class="card-body">

                    <a href="{{ route('surveyresponsesexport',request()->route('form_id')) }}" class="btn btn-primary my-2">Export</a>
                    <div class="table-responsive">
                        <table id="" class="table table-sm table-hover border">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Vendor</th>
                                    <th>Prefer Branch</th>
                                    <th>Feedback Count</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach($summaries as $idx=>$item)
                                    <tr >
                                        <td>{{++$idx}}</td>
                                        <td>PRO 1 Global Home Center</td>
                                        <td>{{ $item->branch->branch_name }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>
                                            <a href="/surveyresponses/?branch_id={{ $item->branch_id }}&form_id={{ request()->route('form_id')  }}" class="text-info" ><i class="fas fa-eye"></i></a>
                                            <a href="/surveyresponsesexport/{{ request()->route('form_id')  }}/?branch_id={{ $item->branch_id  }}" class="text-success"><i class="fas fa-download"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                        </table>
                    </div>
                </div>

            </div>


          </div>
     </div>
     <!-- End Page Content Area -->

@endsection



@section("scripts")

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script type="text/javascript">

          $(document).ready(function(){
                // Start Survey Response Chart
                $.ajax({
                    url: `/api/surveyresponsesdashboard/{{  request()->route('form_id') }}`,
                    method: 'GET',
                    success:function(data){
                        $('#responsebranchcount').text(data.totalresponsebranches);

                        $("#responsecount").text(data.totalsurveyresponses);

                        $("#contactresponsecount").text(data.contactsurveyresponses);
                    },
                    error: function(){
                        $('#responsebranchcount').text("Error loading data");
                    }
                });
                //  End Response Branch Chart
          });





     </script>
@endsection
