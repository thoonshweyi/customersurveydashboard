<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "questions";
    protected $primaryKey = "id";
    protected $fillable = [
        'form_id',
        'section_id',
        'name',
        'type',
        'required',
        'image',
    ];


    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
