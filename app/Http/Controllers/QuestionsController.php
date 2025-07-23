<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{

    public function refresh(Request $request,string $id){
        $question = Question::findOrFail($id);

        $form_id = $question->form_id;
        $section_id = $question->section_id;
        $question_id = $question->id;
        if (!$question->import_options) {
            return response()->json(['message' => 'No import_options defined for this question'], 400);
        }

        $importTable = $question->import_options;

        $rows = DB::table($importTable)
                ->where("status_id",1)
                ->orderBy('id','asc')->get();

        $existingOptions = $question->options()->pluck('value')->toArray();
        foreach($rows as $row){
            Option::updateOrCreate([
                'form_id' => $form_id,
                'section_id' => $section_id,
                'question_id' => $question_id,
                "value" => $importTable != 'branches' ? $row->id : $row->branch_id
            ],[
                "name" => $row->mm_name
            ]);
        }

        return redirect()->back();
    }
}
