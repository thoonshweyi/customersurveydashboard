<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "options";
    protected $primaryKey = "id";
    protected $fillable = [
        'form_id',
        'section_id',
        'question_id',
        'name',
        'value',
        'image',
    ];
}
