<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurveyResponsesExport;
use App\Jobs\SurveyResponseMailBoxJob;

class SurveyResponsesController extends Controller
{

    public function dashboard($form_id){
        $summaries = SurveyResponse::select('branch_id')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('branch_id')
        ->with('branch')
        ->where('form_id',$form_id)
        ->get();

        return view("surveyresponses.dashboard",compact('summaries'));
    }

    public function index(Request $request){
        $results = SurveyResponse::query();

        $branch_id = $request->branch_id;
        $form_id = $request->form_id;
        // dd($branch_id);
        if(!empty($branch_id)){
            $results = $results->where("branch_id",$branch_id);
        }

        if(!empty($form_id)){
            $results = $results->where("form_id",$form_id);
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

    public function export(Request $request,$form_id){

        $results = SurveyResponse::query();

        $branch_id = $request->branch_id;
        if(!empty($branch_id)){
            $results = $results->where("branch_id",$branch_id);
        }

        // if(!empty($form_id)){
        //     $results = $results->where("form_id",$form_id);
        // }


        $results = $results->where("form_id",$form_id);
        $surveyresponses = $results->get();
        // dd($surveyresponses);
        $response = Excel::download(new SurveyResponsesExport($surveyresponses,$form_id), "SurveyResponses".Carbon::now()->format('Y-m-d').".xlsx");

        return $response;

    }


    public function emailnotifications(Request $request){
        $data = [
            "to" => $request["cmpemail"] ?? "thoonlay779@gmail.com",
            "subject" => $request["cmpsubject"] ?? "PRO CV Form Received",
            "surveyresponse" => SurveyResponse::find(2),
            "content" => $request["cmpcontent"] ?? "For HR Team"
        ];
                              
        dispatch(new SurveyResponseMailBoxJob($data));

    }
}
