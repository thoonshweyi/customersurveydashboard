<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "sections";
    protected $primaryKey = "id";
    protected $fillable = [
        'form_id',
        'title',
        'description',
        'image',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
