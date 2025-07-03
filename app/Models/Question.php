<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
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
