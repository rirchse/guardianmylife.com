<?php

namespace App\Http\Controllers;

use App\Models\Remainder;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemainderController extends Controller
{
    public function index(){
        $users = User::where('id', Auth::user()->id)
        ->orWhere('agent_id', Auth::user()->id)
        ->pluck('id')
        ->toArray();
            $remainders = Remainder::with('Call','User')->whereIn('user_id', $users)->latest()->paginate(10); 
            // dd($remainders);
            return view('remainder.index',compact('remainders'));
    }
}
