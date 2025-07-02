<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answers";
    protected $primaryKey = "id";
    protected $fillable = [
        'survey_response_id',
        'question_id',
        'option_id',
        'text',
    ];
}
