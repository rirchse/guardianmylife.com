<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remainder extends Model
{
    protected $table ="reminders";
    use HasFactory;

    public function Call()
    {
        return $this->belongsTo(Call::class,'call_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
