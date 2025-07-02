<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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


        $surveyresponse = SurveyResponse::create([
            'form_id' => $request->form_id,
            'branch_id' => $request->branch_id,
            'submitted_at' => Carbon::now()
        ]);

        DB::beginTransaction();
        try{

            foreach ($request->questionanswers as $questionId => $answerData) {
                if (is_array($answerData)) {
                    foreach ($answerData as $optionId) {
                        Answer::create([
                            'survey_response_id' => $surveyresponse->id,
                            'question_id' => $questionId,
                            'option_id' => $optionId,
                        ]);
                    }
                } elseif (is_numeric($answerData)) {
                    // Assume it's a selected option
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
}
