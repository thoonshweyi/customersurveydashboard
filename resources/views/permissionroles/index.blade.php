@extends("layouts.adminindex")

@section("caption","Region List")
@section("content")
                         
     <!-- Start Page Content Area -->
     <div class="container-fluid">

          <div class="col-md-12">
               <form action="{{route('permissionroles.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row align-items-end">
                         <div class="col-md-2 form-group mb-3">
                              <label for="role_id">Role</label>
                              <select name="role_id" id="role_id" class="form-control form-control-sm rounded-0 role_id">
                                   <option value="" selected disabled>Choose a role</option>
                                   @foreach($roles as $role)
                                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                                   @endforeach     
                              </select>
                         </div>
                         <div class="col-md-2 form-group mb-3">
                              <label for="permission_id">Permission</label>
                              <select name="permission_id[]" id="permission_id" class="form-control form-control-sm rounded-0 permission_id select2" multiple="multiple">
                                   <option value="" disabled>Choose Multi Permission</option>
                                   @foreach($permissions as $permission)
                                        <option value="{{$permission['id']}}">{{$permission['name']}}</option>
                                   @endforeach 
                              </select>
                         </div>

                         <div class="col-md-2 mb-3 text-sm-end text-md-start">
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
                         <th>Role</th>
                         <th>Permission</th>
                         <th>Created At</th>
                         <th>Updated At</th>
                         <th>Action</th>
                    </thead>
          
                    <tbody>
                         @foreach($permissionroles as $idx=>$permissionrole)
                         <tr id="tablerole_{{$permissionrole->id}}">
                              <td>
                                   <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$permissionrole->id}}"/>
                              </td>
                              <td>{{++$idx}}</td>
                              <td>{{ $permissionrole->role["name"] }}</td>
                              <td>{{ $permissionrole->permission["name"] }}</td>
                              <td>{{ $permissionrole->created_at->format('d M Y') }}</td>
                              <td>{{ $permissionrole->updated_at->format('d M Y') }}</td>
                              <td>
                                   <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$permissionrole->id}}" data-role="{{ $permissionrole->role_id }}" data-permission="{{ $permissionrole->permission_id }}" ><i class="fas fa-pen"></i></a>
                                   <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                              </td>
                              <form id="formdelete-{{ $idx }}" class="" action="{{route('permissionroles.destroy',$permissionrole->id)}}" method="POST">
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
                                                  <label for="editrole_id">Role</label>
                                                  <select name="editrole_id" id="editrole_id" class="form-control form-control-sm rounded-0 role_id">
                                                       @foreach($roles as $role)
                                                            <option value="{{$role['id']}}">{{$role['name']}}</option>
                                                       @endforeach     
                                                  </select>
                                             </div>

                                              <div class="col-md-6 form-group mb-3">
                                                  <label for="editpermission_id">Permission</label>
                                                  <select name="editpermission_id" id="editpermission_id" class="form-control form-control-sm rounded-0 permission_id">
                                                       @foreach($permissions as $permission)
                                                            <option value="{{$permission['id']}}">{{$permission['name']}}</option>
                                                       @endforeach   
                                                  </select>
                                             </div>

                                             <div class="col-md-12 text-sm-end text-start mb-3">
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

@section("css")
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section("scripts")
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                   
                    
                    $("#editrole_id").val($(this).attr("data-role"));
                    $("#editpermission_id").val($(this).attr("data-permission"));

                    const getid = $(this).attr("data-id");
                    $("#formaction").attr("action",`/permissionroles/${getid}`);

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
                                   url:"{{ route('permissionroles.bulkdeletes') }}",
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
                         url:"permissionrolesstatus",
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

               $('.select2').select2({
                    placeholder: "Choose Multi Permission"
               });

          });


          


     </script>
@endsection