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
        //
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
