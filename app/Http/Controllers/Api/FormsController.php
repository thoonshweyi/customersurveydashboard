<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use App\Models\Answer;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FormsController extends Controller
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
        $form = Form::findOrFail($id);


        $formattedForm = [
            'id' => $form->id,
            'title' => $form->title,
            'description' => $form->description,
            'sections' => $form->sections()->orderBy("id",'asc')->get()->map(function ($section) {
                return [
                    'id' => $section->id,
                    'title' => $section->title,
                    'description' => $section->description,
                    'questions' => $section->questions()->orderBy("id",'asc')->get()->map(function ($question) {
                        return [
                            'id' => $question->id,
                            'name' => $question->name,
                            'type' => $question->type,
                            'required' => $question->required,
                            'options' => $question->options()->orderBy("id",'asc')->get()->map(function ($option) {
                                return [
                                    'id' => $option->id,
                                    'name' => $option->name,
                                    'value' => $option->value,
                                ];
                            })->toArray(),
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ];
        $formattedForm = collect($formattedForm);
        return response()->json($formattedForm);
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


    public function report(Request $request,string $id){
        $form = Form::find($id);
        $branch_ids = $request->branch_ids ?? Branch::get()->pluck('branch_id');
        // dd($branch_ids);

        // $optionCounts = DB::table('answers')
        //                     ->select('option_id', DB::raw('COUNT(*) as total'))
        //                     ->groupBy('option_id')
        //                     //->get(); 
        //                     ->pluck('total','option_id');
        $optionCounts = DB::table('answers')
            ->select('answers.option_id', DB::raw('COUNT(*) as total'))
            ->join('survey_responses', 'answers.survey_response_id', '=', 'survey_responses.id')
            ->whereIn('survey_responses.branch_id', $branch_ids)
            ->groupBy('answers.option_id')
            ->pluck('total', 'answers.option_id');

        $results = [
            'questions' => $form->questions()->orderBy("id",'asc')->get()->map(function ($question)  use ($optionCounts,$branch_ids) {
                    $average = null;

                    if ($question->type === 'rating') {
                        $average = DB::table('answers')
                        ->join('options', 'answers.option_id', '=', 'options.id')
                        ->where('answers.question_id', $question->id)
                        ->join('survey_responses', 'answers.survey_response_id', '=', 'survey_responses.id')
                        ->whereIn('survey_responses.branch_id', $branch_ids)
                        ->avg(DB::raw('CAST(options.value AS NUMERIC)'));
                    }
                    return [
                        'id' => $question->id,
                        'name' => $question->name,
                        'type' => $question->type,
                        'required' => $question->required,
                        'average' => round($average, 2),
                        'options' => $question->options()->orderBy("id",'asc')->get()->map(function ($option) use ($optionCounts) {
                            return [
                                'id' => $option->id,
                                'name' => $option->name,
                                'value' => $option->value,
                                'count' => $optionCounts["$option->id"] ?? 0,
                            ];
                        })->toArray(),
                ];
            })
        ];
        // dd($results);

        return response()->json($results);

    }
}
