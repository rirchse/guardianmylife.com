<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentleadsAssign extends Model
{
    use HasFactory;
    // protected $casts = [
    //     'lead_id' => 'array',
    //  ];

     protected $table = 'agentleads_assigns';
     protected $primaryKey = 'id';
}
