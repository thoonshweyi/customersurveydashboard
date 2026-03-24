<?php

namespace App\Http\Controllers;

use App\Exports\SurveyResponsesExport;
use App\Jobs\SurveyResponseMailBoxJob;
use App\Models\Branch;
use App\Models\Form;
use App\Models\SurveyResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $branch_id = $request->branch_id;
        $form_id = $request->form_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;


        $form = Form::find($form_id);
        $branch = Branch::where('branch_id',$branch_id)->first();

        $results = SurveyResponse::query();
        if(!empty($branch_id)){
            $results = $results->where("branch_id",$branch_id);
        }

        if(!empty($form_id)){
            $results = $results->where("form_id",$form_id);
        }

        if (!empty($from_date)) {
            $results = $results->whereDate("submitted_at", ">=", $from_date);
        }

        if (!empty($to_date)) {
            $results = $results->whereDate("submitted_at", "<=", $to_date);
        }


        $surveyresponses = $results->orderBy("created_at","desc")->paginate(10);
        $gettoday = Carbon::today()->format("Y-m-d");

        return view("surveyresponses.index",compact('surveyresponses','gettoday','form','branch'));
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
