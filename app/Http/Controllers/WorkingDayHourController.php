<?php

namespace App\Http\Controllers;

use App\Models\WorkingDayHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkingDayHourController extends Controller
{
    public function store(Request $request)
    {
        $hours = $request->hours;
        $minutes = $request->minutes;
        $seconds = $request->seconds;
    
        $time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        $hours = new WorkingDayHour();
        $hours->user_id = Auth::user()->id;
        $hours->workingHours = $time;
        $hours->date = Carbon::now()->toDateString();
        $hours->save();
         return response()->json(['message' => 'Time stored in the database!']);
    }
}
