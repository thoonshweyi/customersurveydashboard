@extends("layouts.adminindex")

@section("caption","Country List")
@section("content")
                         
     <!-- Start Page Content Area -->
     <div class="container-fluid">

          <div class="col-md-12">
               <form action="{{route('permissions.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row align-items-end">
                         <div class="col-md-3 form-group mb-3">
                              <label for="name">Name <span class="text-danger">*</span></label>
                              @error("name")
                                   <span class="text-danger">{{ $message }}<span>
                              @enderror
                              <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Permission Name" value="{{ old('name') }}"/>
                         </div>

                         <div class="col-md-3 form-group mb-3">
                              <label for="status_id">Status</label>
                              <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                   @foreach($statuses as $status)
                                        <option value="{{$status['id']}}">{{$status['name']}}</option>
                                   @endforeach     
                              </select>
                         </div>

                         <div class="col-md-6 mb-3 text-sm-end text-md-start">
                              <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                              <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                         </div>
                    </div>
               </form>
          </div>

          <hr/>

          <div class="col-md-12">
               <div>
                    <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
               </div>
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

               <table id="mytable" class="table table-sm table-hover border">
          
                    <thead>
                         <th>
                              <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                         </th>
                         <th>No</th>
                         <th>Name</th>
                         <th>Status</th>
                         <th>By</th>
                         <th>Created At</th>
                         <th>Updated At</th>
                         <th>Action</th>
                    </thead>
          
                    <tbody>
                         @foreach($permissions as $idx=>$permission)
                         <tr id="tablerole_{{$permission->id}}">
                              <td>
                                   <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$permission->id}}"/>
                              </td>
                              <td>{{++$idx}}</td>
                              <td>{{ $permission->name }}</td>
                              <td>
                                   <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input change-btn" {{ $permission->status_id === 3 ? "checked" : "" }} data-id="{{ $permission->id }}"/>
                                   </div>
                              </td>
                              <td>{{ $permission->user["name"] }}</td>
                              <td>{{ $permission->created_at->format('d M Y') }}</td>
                              <td>{{ $permission->updated_at->format('d M Y') }}</td>
                              <td>
                                   <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$permission->id}}" data-name="{{$permission->name}}" data-status="{{ $permission->status_id }}"><i class="fas fa-pen"></i></a>
                                   <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                              
                              </td>
                              <form id="formdelete-{{ $idx }}" class="" action="{{route('permissions.destroy',$permission->id)}}" method="POST">
                                   @csrf
                                   @method("DELETE")
                              </form>
                         </tr>
                         @endforeach
                    </tbody>
          
               </table>
          

          </div>
     </div>
     <!-- End Page Content Area -->

     <!-- START MODAL AREA -->
          <!-- start edit modal -->
               <div id="editmodal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h6 class="modal-title">Edit Form</h6>
                                   <button type="" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <div class="modal-body">
                                   <form id="formaction" action="" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="row align-items-end">
                                             <div class="col-md-6 form-group mb-3">
                                                  <label for="editname">Name <span class="text-danger">*</span></label>
                                                  <input type="text" name="editname" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter permission Name" value="{{ old('name') }}"/>
                                             </div>

                                             <div class="col-md-4 form-group mb-3">
                                                  <label for="editstatus_id">Status</label>
                                                  <select name="editstatus_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                                       @foreach($statuses as $status)
                                                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                                                       @endforeach     
                                                  </select>
                                             </div>
                    
                                             <div class="col-md-2 text-sm-end text-start mb-3">
                                                  <button type="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>

                              <div class="modal-footer">

                              </div>
                         </div>
                    </div>
               </div>
          <!-- end edit modal -->
     <!-- END MODAL AREA -->
@endsection



@section("scripts")

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script type="text/javascript">

          $(document).ready(function(){
               // Start Delete Item
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
               // End Delete Item

               // Start Edit Form
               $(document).on("click",".editform",function(e){
                    // console.log($(this).attr("data-id"),$(this).attr("data-name"));
                    
                    $("#editname").val($(this).attr("data-name"));
                    $("#editstatus_id").val($(this).attr("data-status"));

                    const getid = $(this).attr("data-id");
                    $("#formaction").attr("action",`/permissions/${getid}`);

                    e.preventDefault();
               });
               // End Edit Form

               // Start Bulk Delete 
               $("#selectalls").click(function(){
                    $(".singlechecks").prop("checked",$(this).prop("checked"));
               });

               $("#bulkdelete-btn").click(function(){
                    let getselectedids = [];
                    
                    console.log($("input:checkbox[name=singlechecks]:checked"));
                    $("input:checkbox[name='singlechecks']:checked").each(function(){
                         getselectedids.push($(this).val());
                    });
                    
                    
                    // console.log(getselectedids); // (4) ['1', '2', '3', '4']
          


                    Swal.fire({
                         title: "Are you sure?",
                         text: `You won't be able to revert!`,
                         icon: "warning",
                         showCancelButton: true,
                         confirmButtonColor: "#3085d6",
                         cancelButtonColor: "#d33",
                         confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                         if (result.isConfirmed) {
                              // data remove 
                              $.ajax({
                                   url:"{{ route('permissions.bulkdeletes') }}",
                                   type:"DELETE",
                                   dataType:"json",
                                   data:{
                                        selectedids:getselectedids,
                                        _token:"{{ csrf_token() }}"
                                   },
                                   success:function(response){
                                        console.log(response);   // 1
                                        
                                        if(response){
                                             // ui remove
                                             $.each(getselectedids,function(key,val){
                                                  $(`#tablerole_${val}`).remove();
                                             });
                                        
                                             Swal.fire({
                                                  title: "Deleted!",
                                                  text: "Your file has been deleted.",
                                                  icon: "success"
                                             });
                                        }
                                   },
                                   error:function(response){
                                        console.log("Error: ",response)
                                   }
                              });
                              
                         }
                    });   
               });
               // End Bulk Delete 

               //Start change-btn
               $(document).on("change",".change-btn",function(){

                    var getid = $(this).data("id");
                    // console.log(getid); // 1 2

                    var setstatus = $(this).prop("checked") === true ? 3 : 4;
                    // console.log(setstatus); // 3 4

                    $.ajax({
                         url:"permissionsstatus",
                         type:"GET",
                         dataType:"json",
                         data:{"id":getid,"status_id":setstatus},
                         success:function(response){
                              console.log(response); // {success: 'Status Change Successfully'}
                              console.log(response.success); // Status Change Successfully
                         
                              Swal.fire({
                                   title: "Updated!",
                                   text: "Updated Successfully",
                                   icon: "success"
                              });
                         }
                    });
               });
               // End change btn
          });


          


     </script>
@endsection