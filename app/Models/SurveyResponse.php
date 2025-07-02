<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;
    protected $table = "survey_responses";
    protected $primaryKey = "id";
    protected $fillable = [
        'form_id',
        'branch_id',
        'submitted_at',
    ];
}
