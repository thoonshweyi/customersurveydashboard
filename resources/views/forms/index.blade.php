@extends("layouts.adminindex")

@section("caption","form List")
@section("content")

     <!-- Start Page Content Area -->
     <div class="container-fluid">
          <div class="col-md-12">

               <a href="{{route('forms.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>
               <hr/>

               {{-- <div class="col-md-12">
                    <form action="" method="">
                         <div class="row justify-content-end">
                              <div class="col-md-2 col-sm-6 mb-2">
                                   <div class="form-group">
                                        <select name="filterstatus_id" id="filterstatus_id" class="form-control form-control-sm rounded-0">
                                             <!-- <option value="" selected>Choose Status....</option>      -->
                                             @foreach($filterstatuses as $id=>$name)
                                                  <option value="{{$id}}" {{ $id == request('filterstatus_id') ? 'selected' : '' }}>{{ $name }}</option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                         </div>
                    </form>
               </div> --}}

               <div class="col-md-12">
                    <table id="mytable" class="table table-sm table-hover border">

                         <thead>
                              <th>No</th>
                              <th>Name</th>
                              <th>Status</th>
                              <th>By</th>
                              <th>Created At</th>
                              <th>Updated At</th>
                              <th>Action</th>
                         </thead>

                         <tbody>
                              @foreach($forms as $idx=>$form)
                              <tr>
                                   <td>{{++$idx}}</td>
                                   <td>
                                        {{-- <img src="{{ asset($form->image) }}" class="rounded-circle" alt="{{$form->name}}" width="20" height="20"/> --}}
                                        {{-- <a href="{{route('forms.show',$form->id)}}">{{$form->title}}</a></td> --}}
                                        <a href="javascript:void(0);">{{$form->title}}</a></td>
                                   <td>{{ $form->status->name }}</td>
                                   <td>{{ $form->user["name"] }}</td>
                                   <td>{{ $form->created_at->format('d M Y') }}</td>
                                   <td>{{ $form->updated_at->format('d M Y') }}</td>
                                   <td>
                                        <a href="{{ route('forms.edit',$form->id) }}" class="text-info"><i class="fas fa-pen"></i></a>
                                        {{-- <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a> --}}
                                   </td>
                                   {{-- <form id="formdelete-{{ $idx }}" class="" action="{{route('forms.destroy',$form->id)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                   </form> --}}
                              </tr>
                              @endforeach
                         </tbody>

                    </table>
                    {{ $forms->links("pagination::bootstrap-4") }}
               </div>


          </div>
     </div>
     <!-- End Page Content Area -->
@endsection


@section("scripts")
     <script type="text/javascript">
          // Start Filter
          const getfilterstatus = document.getElementById("filterstatus_id");
          getfilterstatus.addEventListener("click",function(e){
               // const getstatusid = this.value;
               // const getstatusid = this.options[this.selectedIndex].value;
               const getstatusid = this.value || this.options[this.selectedIndex].value;
               // console.log(getstatusid);

               let getcururl = window.location.href;
               // console.log(getcururl); // http://127.0.0.1:8000/cities?filtername=yan
               // console.log(getcururl.split("?")); // ['http://127.0.0.1:8000/cities', 'filtername=yan']
               // console.log(getcururl.split("?")[0]); //

               window.location.href = getcururl.split("?")[0] + "?filterstatus_id="+getstatusid;

               e.preventDefault();
          });
          // End Filter


          $(document).ready(function(){
               $(".delete-btns").click(function(){
                    // console.log('hay');

                    var getidx = $(this).data("idx");
                    // console.log(getidx);

                    if(confirm(`Are you sure !!! you want to Delete ${getidx} ?`)){
                         $('#formdelete-'+getidx).submit();
                         return true;
                    }else{
                         false;
                    }
               });
          });


     </script>
@endsection
