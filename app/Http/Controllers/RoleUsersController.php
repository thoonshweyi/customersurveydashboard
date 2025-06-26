<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
 

class RoleUsersController extends Controller
{
    public function index()
    {
        // http://127.0.0.1:8000/roleusers?filtername=mm
        // dd(request("filtername")); // mm

        $roleusers = RoleUser::get();
        // dd($roleusers);

        $roles = Role::orderBy("name")->where("status_id",3)->get();
        $users = User::orderBy("name")->get();

        return view("roleusers.index",compact("roleusers","roles","users"));
    }
    // request() - get the request form value

    public function store(Request $request)
    {
        $this->validate($request,[
            "role_id"=>"required",
            "user_id"=>"required",
        ]);

       $user = Auth::user();
       $user_id = $user->id;

       $roleuser = new RoleUser();
       $roleuser->role_id = $request["role_id"];
       $roleuser->user_id = $request["user_id"];
       $roleuser->save();
       return redirect(route("roleusers.index"));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "editrole_id"=>"required",
            "edituser_id"=>"required",
        ]);

       $user = Auth::user();
       $user_id = $user['id'];

       $roleuser = RoleUser::findOrFail($id);
       $roleuser->role_id = $request["editrole_id"];
       $roleuser->user_id = $request["edituser_id"];
       $roleuser->save();
       return redirect(route("roleusers.index"));
    }


    public function destroy(string $id)
    {
        $roleuser = RoleUser::findOrFail($id);
        $roleuser->delete();
        return redirect()->back();
    }


    public function bulkdeletes(Request $request)
    {
        try{
            $getselectedids = $request->selectedids;
            RoleUser::whereIn("id",$getselectedids)->delete();
            return response()->json(["success"=>"Selected data have been deleted successfully"]);
        }catch(Exception $e){
            Log::error($e->getMEssage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

}
