<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Form;
use App\Models\Branch;
use App\Models\Option;
use App\Models\Status;
use App\Models\Section;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    public function index()
    {
            $this->authorize('view',Form::class);
        $forms = Form::paginate(10);
        return view("forms.index",compact("forms"));
    }
    public function create()
    {
            $this->authorize('create',Form::class);
        $optionimporttables = ["branches", "categories"];
        $branches = Branch::all();
        return view("forms.create",compact("optionimporttables","branches"));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            "title"=> "required",
            "description"=> "required",
            "sections" => "array|required",
            "sections.*.title" => "required",
            "sections.*.questions" => "array|required",
            "sections.*.questions.*.name" => "required",
            "sections.*.questions.*.type" => "required",
            "sections.*.questions.*.options.*" => "required",
            "sections.*.questions.*.options.*.name" => "required",
        ],[
            "title" => "Please write Form Title.",
            "description" => "Please write Form Description.",
            "sections.*.title" => "Please fill section title.",
            "sections.*.questions.*.name" => "Please fill question text.",
            "sections.*.questions.*.type.required" => "Please choose question type.",
            "sections.*.questions.*.options.*.required" => "Please fill option value.",
            "sections.*.questions.*.options.*.name.required" => "Pease fill option text",
        ]);
        // dd('Form saved successfully');

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user_id = $user->id;

            $title = $request->title;
            $description = $request->description;

                $this->authorize('create',Form::class);
            $form = Form::create([
                'title'=>$title,
                'slug'=> Str::slug($title),
                'description'=> $description,
                'status_id'=> 1,
                'user_id'=> $user_id
            ]);

            // dd($request->sections);
            foreach($request->sections as $sectionIndex => $reqsection){
                $sectiontitle = $reqsection["title"];
                $sectiondescription = $reqsection["description"];
                $section = Section::create([
                    'form_id' => $form->id,
                    'title' => $sectiontitle,
                    'description' => $sectiondescription,
                    // 'image',
                ]);

                foreach($reqsection["questions"] ?? [] as $questionIndex => $reqquestion){
                    $question = Question::create([
                        'form_id' => $form->id,
                        'section_id' => $section->id,
                        'name' => $reqquestion["name"],
                        'type' => $reqquestion["type"],
                        'required' => true,
                        // 'image' => ,
                    ]);

                    if (!empty($reqquestion['options'])){
                        foreach ($reqquestion['options'] as $option){
                            $option = Option::create([
                                'form_id'=> $form->id,
                                'section_id'=> $section->id,
                                'question_id' => $question->id,
                                'name' => $option['name'],
                                'value' => $option['value'] ?? '',
                                // 'image' => ,
                            ]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('forms.index')
                ->with('success', 'User created successfully');
        } catch (Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()
                ->intended(route("forms.create"))
                ->withInput()
                ->with('error', 'Fail to create form!');
        }



    }


    public function edit(Form $form){
            $this->authorize('edit',$form);

        $statuses = Status::whereIn("id",[1,2])->get();
        $optionimporttables = ["branches", "categories"];

         $formattedForm = old('sections') ? [
        'id' => $form->id,
        'title' => old('title'),
        'description' => old('description'),
        'sections' => old('sections')
        ] : [
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
        // dd($formattedForm);


        return view("forms.edit",compact('form','optionimporttables'))->with("statuses",$statuses)->with("formattedForm",$formattedForm);
    }




    public function update(Request $request, string $id) {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "sections" => "array|required",
            "sections.*.title" => "required",
            "sections.*.questions" => "array|required",
            "sections.*.questions.*.name" => "required",
            "sections.*.questions.*.type" => "required",
            "sections.*.questions.*.options.*" => "required",
            "sections.*.questions.*.options.*.name" => "required",
        ], [
            "title" => "Please write Form Title.",
            "description" => "Please write Form Description.",
            "sections.*.title" => "Please fill section title.",
            "sections.*.questions.*.name" => "Please fill question text.",
            "sections.*.questions.*.type.required" => "Please choose question type.",
            "sections.*.questions.*.options.*.required" => "Please fill option value.",
            "sections.*.questions.*.options.*.name.required" => "Please fill option text",
        ]);

        DB::beginTransaction();
        try {
            $form = Form::findOrFail($id);
                $this->authorize('edit',$form);
            $form->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
            ]);

            $existingSectionIds = [];
            $existingQuestionIds = [];
            $existingOptionIds = [];

            foreach ($request->sections as $sectionData) {
                if (isset($sectionData['id'])) {
                    $section = Section::find($sectionData['id']);
                    $section->update([
                        'title' => $sectionData['title'],
                        'description' => $sectionData['description'] ?? null,
                    ]);
                } else {
                    $section = Section::create([
                        'form_id' => $form->id,
                        'title' => $sectionData['title'],
                        'description' => $sectionData['description'] ?? null,
                    ]);
                }

                $existingSectionIds[] = $section->id;

                foreach ($sectionData['questions'] ?? [] as $questionData) {
                    if (isset($questionData['id'])) {
                        $question = Question::find($questionData['id']);
                        $question->update([
                            'name' => $questionData['name'],
                            'type' => $questionData['type'],
                            'required' => true,
                        ]);
                    } else {
                        $question = Question::create([
                            'form_id' => $form->id,
                            'section_id' => $section->id,
                            'name' => $questionData['name'],
                            'type' => $questionData['type'],
                            'required' => true,
                        ]);
                    }

                    $existingQuestionIds[] = $question->id;

                    foreach ($questionData['options'] ?? [] as $optionData) {
                        if (isset($optionData['id'])) {
                            $option = Option::find($optionData['id']);
                            $option->update([
                                'name' => $optionData['name'],
                                'value' => $optionData['value'] ?? '',
                            ]);
                        } else {
                            $option = Option::create([
                                'form_id' => $form->id,
                                'section_id' => $section->id,
                                'question_id' => $question->id,
                                'name' => $optionData['name'],
                                'value' => $optionData['value'] ?? '',
                            ]);
                        }

                        $existingOptionIds[] = $option->id;
                    }
                }
            }

            Option::where('form_id', $form->id)
                ->whereNotIn('id', $existingOptionIds)
                ->delete();

            Question::where('form_id', $form->id)
                ->whereNotIn('id', $existingQuestionIds)
                ->delete();

            Section::where('form_id', $form->id)
                ->whereNotIn('id', $existingSectionIds)
                ->delete();

            DB::commit();
            return redirect()->route('forms.index')->with('success', 'Form updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->route('forms.edit', $id)->withInput()->with('error', 'Failed to update form!');
        }
    }


    public function report(Request $request,$id){

        $form = Form::find($id);
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
        dd($formattedForm->title);
        return view("forms.report")->with("formattedForm","formattedForm");

    }
}
