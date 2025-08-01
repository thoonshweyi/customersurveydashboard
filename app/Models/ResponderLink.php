<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponderLink extends Model
{
    use HasFactory;

    protected $table = "responder_links";
    protected $primaryKey = "id";
    protected $fillable = [
        "form_id",
        "branch_id",
        "url",
        "image",
        "status_id",
        "user_id",
    ];

    public function form(){
        return $this->belongsTo(Form::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class,"branch_id","branch_id");
    }
}
