<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurveyResponse extends Model
{
    use HasFactory;
    protected $table = "survey_responses";
    protected $primaryKey = "id";
    protected $fillable = [
        'form_id',
        'branch_id',
        'submitted_at',
        'responder_id'
    ];

    public function form(){
        return $this->belongsTo(Form::class,"form_id","id");
    }

    public function branch(){
        return $this->belongsTo(Branch::class,"branch_id","branch_id");
    }

    public function responder(){
        return $this->belongsTo(Responder::class,"responder_id","id");
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function respondent() {

        try{
            $keywords = ['name', 'phone', 'age', 'gender'];
            $respondent = [];
            $question_arr = $this->form->questions()
                ->whereIn(\DB::raw('LOWER(name)'), $keywords)
                ->pluck("name",'id');

            // dd($question_arr);

            foreach($question_arr as $question_id=>$question_name){
                $answer = $this->answers()->where("question_id",$question_id)->first();
                // dd($answer);
                $respondent[Str::snake($question_name)] = $answer?->text ?? $answer?->option?->name;
            }
            // dd($respondent);
            return $respondent;
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }

    }

    public function questionanswers($question_id){
        $answers = $this->answers()->where("question_id",$question_id)->get();
        // dd($answers);
        return $answers;
    }


}
