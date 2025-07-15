<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use Illuminate\Http\Request;
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
}
