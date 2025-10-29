<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Responder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SurveyResponseMailBoxJob;

class SurveyResponsesController extends Controller
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

        $validator = Validator::make($request->all(), [
            'form_id' => 'required|exists:forms,id',
            'questionanswers' => 'required|array',
            'branch_id' => 'required|exists:branches,id',
        ], [
            'form_id.required' => 'Form ID is required.',
            'form_id.exists' => 'Invalid Form.',
            'questionanswers.required' => 'Answers are required.',
            'questionanswers.array' => 'Answers must be an array.',
            'branch_id.required' => 'From Branch is required.',
            'branch_id.exists' => 'Invalid Branch.',
        ]);

        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()],422);
        }

        DB::beginTransaction();
        try{

            $responder_arr = $this->getResponder($request->questionanswers);
            $responder = Responder::firstOrCreate($responder_arr);
            $surveyresponse = SurveyResponse::create([
                'form_id' => $request->form_id,
                'branch_id' => $request->branch_id,
                'submitted_at' => Carbon::now(),
                'responder_id' => $responder->id
            ]);

            foreach ($request->questionanswers as $questionId => $answerData) {
                $question = Question::find($questionId);
                if (is_array($answerData)) {
                    foreach ($answerData as $optionId) {
                        Answer::create([
                            'survey_response_id' => $surveyresponse->id,
                            'question_id' => $questionId,
                            'option_id' => $optionId,
                        ]);
                    }
                } elseif (is_numeric($answerData) && $question->type != 'text' && $question->type != 'textarea') {
                    Answer::create([
                        'survey_response_id' => $surveyresponse->id,
                        'question_id' => $questionId,
                        'option_id' => $answerData,
                    ]);
                } else {
                    Answer::create([
                        'survey_response_id' => $surveyresponse->id,
                        'question_id' => $questionId,
                        'text' => $answerData,
                    ]);
                }
            }
            DB::commit();

            $form = $surveyresponse->form;
            if($form->email_noti == 3){
                // Email Notification
                $data = [
                    "to" =>  $form->collector_email,
                    "subject" => "New ". $form->title ."Response Received",
                    "surveyresponse" => $surveyresponse,
                    "content" => $request["cmpcontent"] ?? "For HR Team"
                ];
                Log::info($data);

                dispatch(new SurveyResponseMailBoxJob($data));
            }


            return response()->json(['message' => 'Answers saved successfully',"surveyresponse"=>$surveyresponse]);
        }catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());

            return response()->json(["error"=>$e->getMessage()]);
        }

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


    public function dashboard($form_id){
        $totalsurveyresponses = SurveyResponse::where('form_id',$form_id)->count();
        $totalresponsebranches = SurveyResponse::select('branch_id')
                                        ->selectRaw('COUNT(*) as total')
                                        ->groupBy('branch_id')
                                        ->with('branch')
                                        ->where('form_id',$form_id)
                                        ->pluck('total', 'branch_id')
                                        ->count();
        return response()->json([
            "totalresponsebranches" => $totalresponsebranches,
            "totalsurveyresponses" => $totalsurveyresponses,
            "contactsurveyresponses"=> $totalsurveyresponses
        ]);
    }

    public function getResponder($questionAnswers){
        $fillableFields = (new Responder())->getFillable();

        $questionIds = array_keys($questionAnswers);

        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        // Must include not null field
        $responder = [
            "name" => "Responder"
        ];

        foreach ($questionAnswers as $questionId => $answerValue) {
            if (isset($questions[$questionId])) {
                $fieldName = Str::slug($questions[$questionId]->name);
                if (in_array($fieldName, $fillableFields)) {
                    $responder[$fieldName] = $answerValue;
                }
            }
        }

        return $responder;
    }


}
