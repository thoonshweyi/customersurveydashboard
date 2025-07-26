@extends("layouts.adminindex")

@section("caption","Country List")
@section("content")

     <!-- Start Page Content Area -->
     <div id="contentarea" class="container-fluid">
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

               <table id="" class="table table-sm table-hover border">

                    <thead>
                         <th>No</th>
                         <th>Submitted At</th>
                         <th>Responder Name</th>
                         <th>Responder Phone</th>
                         <th>Branch</th>
                         <th>Form</th>
                         {{-- <th>Created At</th>
                         <th>Updated At</th> --}}
                         <th>Action</th>
                    </thead>

                    <tbody>
                         @foreach($surveyresponses as $idx=>$surveyresponse)
                         <tr>

                              <td>{{++$idx}}</td>
                              <td>{{ \Carbon\Carbon::parse($surveyresponse->submitted_at)->format('d M Y h:i:s') }}</td>
                                <td>
                                    {{ $surveyresponse->responder?->name ?? 'Responder' }}
                                </td>
                                <td>
                                    {{ $surveyresponse->responder?->phone ?? "No Phone" }}
                                </td>
                              <td>{{ $surveyresponse->branch->branch_name }}</td>
                              <td>{{ $surveyresponse->form->title }}</td>
                              {{-- <td>{{ $surveyresponse->created_at->format('d M Y') }}</td>
                              <td>{{ $surveyresponse->updated_at->format('d M Y') }}</td> --}}

                              <td>
                                    <a href="{{ route('surveyresponses.show',$surveyresponse->id) }}" class="text-info" ><i class="fas fa-eye"></i></a>
                              </td>
                              <form id="formdelete-{{ $idx }}" class="" action="{{route('surveyresponses.destroy',$surveyresponse->id)}}" method="POST">
                                   @csrf
                                   @method("DELETE")
                              </form>
                         </tr>
                         @endforeach
                    </tbody>

               </table>
                {{ $surveyresponses->appends(request()->all())->links("pagination::bootstrap-4") }}

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
