<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
 

class PermissionsController extends Controller
{
    public function index()
    {
        // http://127.0.0.1:8000/permissions?filtername=mm
        // dd(request("filtername")); // mm

        $permissions = Permission::where(function($query){
            if($getname = request("filtername")){
                $query->where("name","LIKE","%".$getname."%");
            }
        })->get();
        // dd($permissions);

        $statuses = Status::whereIn("id",[3,4])->get();

        return view("permissions.index",compact("permissions","statuses"));
    }
    // request() - get the request form value

    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => "required|unique:permissions,name",
        ]);

       $user = Auth::user();
       $user_id = $user->id;

       $permission = new Permission();
       $permission->name = $request["name"];
       $permission->status_id = $request["status_id"];
       $permission->slug = Str::slug($request["name"]);
       $permission->user_id = $user_id;

       $permission->save();
       return redirect(route("permissions.index"));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "editname" => "required|unique:permissions,name,".$id,
        ]);

       $user = Auth::user();
       $user_id = $user['id'];

       $permission = Permission::findOrFail($id);
       $permission->name = $request["editname"];
       $permission->status_id = $request["editstatus_id"];
       $permission->slug = Str::slug($request["name"]);
       $permission->user_id = $user_id;

       $permission->save();
       return redirect(route("permissions.index"));
    }


    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back();
    }

    public function typestatus(Request $request){
        $permission = Permission::findOrFail($request["id"]);
        $permission->status_id = $request["status_id"];
        $permission->save();
    
        return response()->json(["success"=>"Status Change Successfully"]);
    }

    public function bulkdeletes(Request $request)
    {
        try{
            $getselectedids = $request->selectedids;
            Permission::whereIn("id",$getselectedids)->delete();
            return response()->json(["success"=>"Selected data have been deleted successfully"]);
        }catch(Exception $e){
            Log::error($e->getMEssage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    
}
