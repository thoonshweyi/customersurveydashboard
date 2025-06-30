<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Form;
use App\Models\Branch;
use App\Models\Option;
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
        // return view("forms.index");
    }
    public function create()
    {
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
            $form = Form::create([
                'title'=>$title,
                'slug'=> Str::slug($title),
                'description'=> $description,
                'status_id'=> 1,
                'user_id'=> $user_id
            ]);

            dd($request->sections);
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
}
