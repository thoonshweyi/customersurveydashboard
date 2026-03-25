@extends("layouts.adminindex")

@section("caption","Country List")
@section("content")

     <!-- Start Page Content Area -->
     <div id="contentarea" class="container-fluid">
          <div class="col-md-12 mb-3">
               <div class="bg-white border-top border-primary border-4 rounded-3 shadow-sm p-3 d-flex align-items-center">
                    <div class="me-3 text-primary">
                         <i class="fas fa-file-alt fa-lg"></i>
                    </div>

                    <div class="flex-grow-1 border-end pe-3">
                         <h6 class="fw-bold mb-0 text-dark">
                              {{ $form->title ?? 'Survey Responses' }}
                         </h6>
                         <div class="d-flex align-items-center mt-1">
                              <span class="badge bg-light text-dark border fw-normal py-1 px-2">
                                   <i class="fas fa-store-alt me-1 text-muted"></i>
                                   {{ $branch->branch_name ?? 'All Branches' }}
                              </span>
                         </div>
                    </div>

                    <div class="ps-3 text-center" style="min-width: 100px;">
                         <div class="h5 fw-bold mb-0 text-primary">
                              {{ $surveyresponses->total() }}
                         </div>
                         <div class="text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                              Responses
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-md-12">
               <form id="search_form" action="{{ url('/surveyresponses') }}" method="GET">
                    <input type="hidden" name="branch_id" value="{{ request()->query('branch_id') }}">
                    <input type="hidden" name="form_id" value="{{ request()->query('form_id') }}">

                    <div class="row align-items-end">
                         <div class="col-md-2 form-group mb-3">
                              <label for="from_date">From Date</label>
                              <input type="date" name="from_date"
                                   class="form-control form-control-sm rounded-0"
                                   value="{{ request('from_date', $gettoday) }}">
                         </div>

                         <div class="col-md-2 form-group mb-3">
                              <label for="to_date">To Date</label>
                              <input type="date" name="to_date"
                                   class="form-control form-control-sm rounded-0"
                                   value="{{ request('to_date', $gettoday) }}">
                         </div>

                         @php
                         $hasFilters =
                              request()->filled('search') ||
                              request()->filled('from_date') ||
                              request()->filled('to_date');
                         @endphp
                         <div class="col-md-2 col-sm-6 mb-3">
                              <div class="input-group">
                                   <input type="text" name="search" id="search" class="form-control form-control-sm rounded-0" placeholder="Search...." value="{{ request('search') }}"/>
                                   @if($hasFilters)
                                   <a href="{{ url('/surveyresponses') }}?branch_id={{ request('branch_id') }}&form_id={{ request('form_id') }}"
                                        class="btn btn-secondary btn-sm"
                                        title="Reset filters">
                                        <i class="fas fa-sync"></i>
                                   </a>
                                   @endif
                                   <button type="submit" id="btn-search" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                              </div>
                         </div>

                         <div class="col-md-2 col-sm-6 mb-3">
                              <button type="button" id="export-btn" class="btn btn-primary my-0">Export</button>
                         </div>

                    </div>
               </form>
          </div>


          <div class="col-md-12">

               <div class="table-responsive rounded-3 shadow-sm">
               <table class="table table-hover align-middle mb-0">

               <thead class="table-primarys sticky-top fw-bolds">
                    <tr class="bg-custom">
                         <th>No</th>
                         <th>Submitted</th>
                         <th>Responder</th>
                         <th>Contact</th>
                         <!-- <th>Branch</th> -->
                         <!-- <th>Form</th> -->
                         <th class="text-center">Action</th>
                    </tr>
               </thead>

               <tbody>
               @forelse($surveyresponses as $idx => $surveyresponse)
                    <tr>

                         <!-- index -->
                         <td class="text-muted">{{ ++$idx }}</td>

                         <!-- date -->
                         <td>
                              <div class="fw-semibolds d-inline">
                                   {{ \Carbon\Carbon::parse($surveyresponse->submitted_at)->format('d M Y') }}
                              </div>
                              <small class="text-muted">
                                   {{ \Carbon\Carbon::parse($surveyresponse->submitted_at)->format('h:i A') }}
                              </small>
                         </td>

                         <!-- name -->
                         <td>
                              <div class="fw-semibolds">
                                   {{ $surveyresponse->responder?->name ?? 'Unknown' }}
                              </div>
                         </td>

                         <!-- phone -->
                         <td>
                              <span class="badge bg-light text-dark border">
                                   {{ $surveyresponse->responder?->phone ?? "No Phone" }}
                              </span>
                         </td>

                         <!-- branch -->
                         <!-- <td>
                              <span class="badge bg-primary-subtle text-primary">
                                   {{ $surveyresponse->branch->branch_name }}
                              </span>
                         </td> -->

                         <!-- form -->
                         <!-- <td>
                              <span class="badge bg-success-subtle text-success">
                                   {{ $surveyresponse->form->title }}
                              </span>
                         </td> -->

                         <!-- action -->
                         <td class="text-center">
                              <a href="{{ route('surveyresponses.show',$surveyresponse->id) }}"
                              class="btn btn-sm btn-light border"
                              class="text-info"
                              title="View">
                                   <i class="fas fa-eye text-info"></i>
                              </a>
                         </td>

                    </tr>
               @empty
                    <tr>
                         <td colspan="7" class="text-center py-4 text-muted">
                              No survey responses found
                         </td>
                    </tr>
               @endforelse
               </tbody>

               </table>
               </div>

               <!-- pagination -->
               <div class="mt-3">
               {{ $surveyresponses->appends(request()->all())->links("pagination::bootstrap-4") }}
               </div>

          </div>
     </div>
     <!-- End Page Content Area -->

@endsection



@section("scripts")

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script type="text/javascript">

          $(document).ready(function(){
               // Start Excel Export
                    $('#export-btn').click(function(){
                         Swal.fire({
                              title: "Processing...",
                              text: "Please wait while we generate report Excel file.",
                              allowOutsideClick: false,
                              didOpen: () => {
                                   Swal.showLoading();
                              }
                         });

                         $.ajax({
                              url: "{{ route('surveyresponsesexport', request('form_id')) }}",
                              type: "GET",
                              // dataType:"json",
                              data: $('#search_form').serialize(),
                              xhrFields: {
                                   responseType: 'blob'
                              },
                              success: function (blob, status, xhr) {
                              
                                   let filename = "SurveyResponses.xlsx";
                                   const disposition = xhr.getResponseHeader('Content-Disposition');
                                   if (disposition && disposition.includes('filename=')) {
                                   filename = disposition.split('filename=')[1].replace(/"/g, '');
                                   }

                                   const url = window.URL.createObjectURL(blob);
                                   const a = document.createElement('a');
                                   a.href = url;
                                   a.download = filename;
                                   document.body.appendChild(a);
                                   a.click();
                                   a.remove();
                                   window.URL.revokeObjectURL(url);

                                   Swal.close();
                              },
                              error:function(response){
                                   console.log("Error:",response);
                                   Swal.close(); // Close the modal

                                   console.log(response.responseJSON.message);
                                   if(response.responseJSON.message == "Maximum execution time of 60 seconds exceeded"){
                                   Swal.fire({
                                        icon: "error",
                                        title: "Oops.... The Excel export took too long and was stopped.",
                                        text: "Please Try Again",
                                        {{-- footer: '<a href="#">Why do I have this issue?</a>' --}}
                                   });
                                   }else{
                                   Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                        footer: '<a href="#">Why do I have this issue?</a>'
                                        });
                                   }
                              },
                              complete: function(){
                              }
                         });
                    });
               // End Excel Export

          });





     </script>
@endsection
