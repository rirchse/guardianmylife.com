<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function User()
    {
        return $this->belongsTo(user::class,'user','id');
    }
}
