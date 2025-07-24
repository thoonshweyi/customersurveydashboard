<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch_name =  (!empty($_GET["branch_name"])) ? ($_GET["branch_name"]) : ('');
        $branch_short_name =  (!empty($_GET["branch_short_name"])) ? ($_GET["branch_short_name"]) : ('');

        $result =  Branch::query();
        if ($branch_name != "") {
            $result = $result->Where('branch_name', 'like', '%' . $branch_name . '%');
        }
        if ($branch_short_name != "") {
            $result = $result->Where('branch_short_name', 'like', '%' . $branch_short_name . '%');
        }

            $result = $result->whereIn('status_id',[1]);
            $result = $result->orderBy('branch_id',"asc")->get();
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function dashboard(){
        $totalbranches = Branch::count();
        $activebranches = Branch::where('branch_active',true)->count();
        return response()->json([
            "totalbranches" => $totalbranches,
            "activebranches" => $activebranches,
        ]);
    }
}
