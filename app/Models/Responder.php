<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responder extends Model
{
    use HasFactory;
    protected $table = "responders";
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "phone"
    ];

}
