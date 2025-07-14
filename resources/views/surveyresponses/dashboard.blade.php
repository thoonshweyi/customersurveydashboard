@extends("layouts.adminindex")

@section("caption","Country List")
@section("content")

     <!-- Start Page Content Area -->
     <div class="container-fluid">
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

                    <a href="{{ route('surveyresponsesexport',1) }}" class="btn btn-primary my-2">Export</a>
                    <div class="table-responsive">
                        <table id="" class="table table-sm table-hover border">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Vendor</th>
                                    <th>Branch</th>
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
                                            <a href="/surveyresponses/?branch_id={{ $item->branch_id }}" class="text-info" ><i class="fas fa-eye"></i></a>
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

          });





     </script>
@endsection
