<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "forms";
    protected $primaryKey = "id";
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status_id',
        'user_id',
        'email_noti',
        'collector_email'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function responderlinks()
    {
        return $this->hasMany(ResponderLink::class);
    }
}
