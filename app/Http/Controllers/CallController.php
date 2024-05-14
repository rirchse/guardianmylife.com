<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Customer;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $calls = Call::with('Customer');

        if($user->role == 2)
        {
            $users = User::where('id', $user->id)
            ->orWhere('agent_id', $user->id)
            ->pluck('id')
            ->toArray();

            $calls = $calls->whereIn('user', $users);
            // dd($calls);
        }
        else
        {
            $calls = $calls->where('user', $user->id);
        }

        $calls = $calls->latest()->paginate(25);
        
        return view('calls.index', compact('calls'));
    }

    public function store(Request $request)
    {
        $last_event = [];
        $hours = $request->hours;
        $minutes = $request->minutes;
        $seconds = $request->seconds;

        $time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        $call = new Call();
        $call->call_time = $time;
        $call->customer_id = $request->customer_id;
        $call->user = Auth::user()->id;
        $call->agent = Auth::user()->agent_id;
        $call->contact = $request->call_experience;

        if($request->aboutcall == 'Not Interested')
        {
            $call->Interested = 1;    
        }

        $customer = Customer::findorfail($request->customer_id);
        $customer->contact = $request->call_experience;
        $customer->Notes = $request->aboutcall;         
        $customer->save(); 

        if($request->aboutcall == 'Review' || $request->aboutcall == 'Appointment' || $request->aboutcall == 'Reminder' || $request->aboutcall == 'Not Interested')
        {
            $reminder = Reminder::where('customer_id', $request->customer_id)->first();

            if($reminder)
            {
                $reminder->delete();
            }

        }

        if($request->aboutcall == 'Review')
        {
            $request->validate([
                'remarks' => 'nullable'
            ]);

            $customer = Customer::findorfail($request->customer_id);
            $customer->Notes = $request->remarks;
            $customer->save();
            $call->notes = $request->remarks;
        }

        if($request->aboutcall == 'Appointment')
        {
            $request->validate([
                'appoint_date_time' => 'nullable',
                'appoint_location' => 'nullable',
                'appoint_note' => 'nullable'
            ]);

            $call->Appointment = 'Yes';       
            $call->appointment_time = $request->appoint_date_time;
            $call->appointment_location = $request->appoint_location;
            $call->appointment_notes = $request->appoint_note;

            $agent = User::find($customer->lead_owner);

            /** required information for google calendar */
            $data = [
                // allways show the agent name
                'title' => 'Appointment with '.$agent->name,
                'email' => $customer->email,
                'date_time' => $request->appoint_date_time,
                // virtually location google meet 
                'location'  => $request->appoint_location,
                'details'   => $request->appoint_note,
            ];

            /** add this appointment to the google calendar */
            $event = New GoogleCalendarController;
            $last_event = $event->create($data);
        //    dd($last_event);

        }
        $call->save();

        /** store last event to the call table */
        if($request->aboutcall == 'Appointment')
        {
            $last_call = Call::orderBy('id', 'DESC')->first();
            Call::where('id', $last_call->id)->update($last_event);
        }

        if($request->aboutcall == 'Reminder')
        {
            $request->validate([
                'remainder_date_time' => 'nullable',
                'remainder_remarks' => 'nullable'
            ]);

            $reminder = new Reminder();
            $reminder->call_id = $call->id;
            $reminder->user_id = Auth::user()->id;
            $reminder->customer_id = $request->customer_id;
            $reminder->reminder_time = $request->remainder_date_time;
            $reminder->note = $request->remainder_remarks;
            $reminder->save();
        }

        return redirect()->route('lead.index')->with('success','Call Added Successfully');
    }
}
