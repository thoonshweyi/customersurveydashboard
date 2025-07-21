<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\City;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PermissionRolesController extends Controller
{
    public function index()
    {
        // http://127.0.0.1:8000/permissionroles?filtername=mm
        // dd(request("filtername")); // mm

        $permissionroles = PermissionRole::orderBy('id')->get();
        // dd($permissionroles);

        $roles = Role::orderBy("name")->where("status_id",3)->get();
        $permissions = Permission::orderBy("name")->where("status_id",3)->get();

        return view("permissionroles.index",compact("permissionroles","roles","permissions"));
    }
    // request() - get the request form value

    public function store(Request $request)
    {
        $this->validate($request,[
            "role_id"=>"required|exists:roles,id",
            "permission_id" => "required|array",
            "permission_id.*"=>"exists:permissions,id",
        ]);

        $role = Role::findOrFail($request["role_id"]);
        $role->permissions()->syncWithoutDetaching($request['permission_id']);

        return redirect(route("permissionroles.index"));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "editrole_id"=>"required",
            "editpermission_id"=>"required",
        ]);

       $user = Auth::user();
       $user_id = $user['id'];

       $permissionrole = PermissionRole::findOrFail($id);
       $permissionrole->role_id = $request["editrole_id"];
       $permissionrole->permission_id = $request["editpermission_id"];
       $permissionrole->save();
       return redirect(route("permissionroles.index"));
    }


    public function destroy(string $id)
    {
        $permissionrole = PermissionRole::findOrFail($id);
        $permissionrole->delete();
        return redirect()->back();
    }


    public function bulkdeletes(Request $request)
    {
        try{
            $getselectedids = $request->selectedids;
            PermissionRole::whereIn("id",$getselectedids)->delete();
            return response()->json(["success"=>"Selected data have been deleted successfully"]);
        }catch(Exception $e){
            Log::error($e->getMEssage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

}
