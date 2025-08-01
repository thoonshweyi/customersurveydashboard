<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Models\RoleUser;
use App\Models\BranchUser;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:view-users', ['only' => ['index']]);
        // $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        // try {
            if ($request->ajax()) {
                $user_name =  (!empty($_GET["user_name"])) ? ($_GET["user_name"]) : ('');
                $user_employee_id =  (!empty($_GET["user_employee_id"])) ? ($_GET["user_employee_id"]) : ('');
                $user_email =  (!empty($_GET["user_email"])) ? ($_GET["user_email"]) : ('');
                $user_role =  (!empty($_GET["user_role"])) ? ($_GET["user_role"]) : ('');
                $branch_id =  (!empty($_GET["branch_id"])) ? ($_GET["branch_id"]) : ('');
                $result =  User::with('roles');
                if ($branch_id != "") {
                    $user_ids = BranchUser::where('branch_id',$branch_id)->pluck('user_id')->toarray();
                    $result = $result->whereIn('id',$user_ids);
                }
                if ($user_name != "") {
                    $result = $result->where('name', 'ilike', '%' . $user_name . '%');
                }
                if ($user_employee_id != "") {
                    $result = $result->where('employee_id', 'ilike', '%' . $user_employee_id . '%');
                }
                if ($user_email != "") {
                    $result = $result->where('email', 'ilike', '%' . $user_email . '%');
                }
                if ($user_role != "") {
                    $result = $result->whereHas(
                        'roles',
                        function ($q) use ($user_role) {
                            $q->where('name','ilike', '%' . $user_role . '%');
                        }
                    );
                }
                $result = $result->get();
                return DataTables::of($result)
                    ->addColumn('branch_name', function ($data) {
                    // return $data;
                       $branches = BranchUser::where('user_id',$data->id)->with('branches')->get();
                       $branch_array = [];
                       foreach ($branches as $branch){
                           $branch_array[] = $branch->branches->branch_name;
                       }
                       return $branch_array;
                    })
                    ->addColumn('role', function ($data) {
                        if( isset($data->roles)){
                            $data = $data->roles;
                            $role_array = [];
                            foreach($data as $d){
                                $role_array[] = $d->name;
                            }
                            return  $role_array;
                        }else{
                            return '';
                        }

                    })
                    ->addColumn('action', function ($data) {
                        return 'action';
                    })
                    ->rawColumns(['action', 'role', 'branch_name'])
                    ->make(true);
            }
            $branches = Branch::select('branch_id', 'branch_name')->get();
            return view('users.index', compact('branches'));
        // } catch (\Exception $e) {
        //     Log::debug($e->getMessage());
        //     return redirect()
        //         ->intended(route("home"))
        //         ->with('error', 'Fail to load Data!');
        // }
    }

    public function create()
    {
        try {
            $branches = Branch::where('branch_active',true)->get();
            $roles = Role::pluck('name', 'id')->all();
            return view('users.create', compact('roles', 'branches'));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to load Create Form!');
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name' => 'required',
                'employee_id' => 'required|unique:users,employee_id',
                'branch_id' => 'required',
                // 'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                // 'roles' => 'required',
            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['status'] = 1;
            unset($input['branch_id']);
            $user = User::create($input);

            $user_id = $user->id;
            $branch_ids = $request->branch_id;
            foreach ($branch_ids  as $branch_id) {
                $userBranch['user_id'] = $user_id;
                $userBranch['branch_id'] = $branch_id;
                BranchUser::create($userBranch);
            }

             // Assign Role
            $roles = $request->roles;
            foreach($roles as $role){
                $roleuser = new RoleUser();
                $roleuser->role_id = $role;
                $roleuser->user_id = $user_id;
                $roleuser->save();
            }

            DB::commit();
            return redirect()->route('users.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to Store User!');
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            $branches = BranchUser::where('user_id', $user->id)->with('branches')->get();
            return view('users.show', compact('user','branches'));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to Load User!');
        }
    }

    public function edit($id)
    {
        try {
            $branches = Branch::get();
            $user = User::find($id);
            $roles = Role::pluck('name', 'id')->all();
            $userRole = $user->roles->pluck('id')->all();
            $userBranches = BranchUser::where('user_id',$user->id)->pluck('branch_id')->toArray();
            return view('users.edit', compact('user', 'roles', 'userRole', 'branches','userBranches'));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to Load Edit Form!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                // 'email' => 'required|email|unique:users,email,' . $id,
                // 'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            unset($input['branch_id']);
            $user = User::find($id);
            $user->update($input);
            $user_id = $user->id;
            DB::table('branch_users')->where('user_id', $user_id)->delete();
            $branch_ids = $request->branch_id;
            foreach ($branch_ids  as $branch_id) {
                $userBranch['user_id'] = $user_id;
                $userBranch['branch_id'] = $branch_id;
                BranchUser::create($userBranch);
            }

            // Assign Role
            $roles = $request->roles;
            DB::table('role_users')->where('user_id', $user_id)->delete();
            foreach($roles as $role){
                $roleuser = new RoleUser();
                $roleuser->role_id = $role;
                $roleuser->user_id = $user_id;
                $roleuser->save();
            }

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("user.profile"))
                ->with('error', 'Fail to update User!');
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to delete User!');
        }
    }

    public function profile()
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            return view('users.profile', compact('user'));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("users.index"))
                ->with('error', 'Fail to Load User Profile!');
        }
    }

    public function update_profile(Request $request)
    {
        // try {
            $request->validate([
                'cpass' => ['required', new MatchOldPassword],
                'npass' => ['required'],
                'vpass' => ['same:npass'],
            ],
            [
                'npass.required' => 'New Password is required!',
                'vpass.required' => 'Verfiy Password is required!',
                'vpass.same' => 'Verfiy Password is not same with New Password!'
            ]);
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->npass)]);
            return redirect()->route('user.profile')->with('success', 'Password Changed successfully');
        // } catch (\Exception $e) {
        //     Log::debug($e->getMessage());
        //     return redirect()
        //         ->intended(route("users.index"))
        //         ->with('error', 'Fail to update User Profile!');
        // }
    }
}
