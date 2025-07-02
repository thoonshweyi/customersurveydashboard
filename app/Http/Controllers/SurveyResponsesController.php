<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyResponsesController extends Controller
{
    public function store(Request $request){
        // dd('hay');
        return response()->json(['message'=>"Survey Responses Stored Successfully"]);
    }
}
