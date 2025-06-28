<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = "forms";
    protected $primaryKey = "id";
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status_id',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
