<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;

class SurveyResponsesController extends Controller
{

    public function dashboard(){
        $summaries = SurveyResponse::select('branch_id')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('branch_id')
        ->with('branch')
        ->get();

        return view("surveyresponses.dashboard",compact('summaries'));
    }

    public function index(Request $request){
        $results = SurveyResponse::query();

        $branch_id = $request->branch_id;
        // dd($branch_id);
        if(!empty($branch_id)){
            $results = $results->where("branch_id",$branch_id);
        }

        $surveyresponses = $results->orderBy("created_at","desc")->paginate(10);

        return view("surveyresponses.index",compact('surveyresponses'));
    }

    public function show(string $id) {
        $surveyresponse = SurveyResponse::find($id);
        $form = Form::find($surveyresponse->form_id);
        // dd($form);

        return view("surveyresponses.show",compact("surveyresponse","form"));
    }
}
