<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Customer;
use App\Models\FinalCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function Index()
    {
        $appoints = Call::where('appointment', 'Yes')
        ->where('attendees', null)
        ->where('applicant', 'No')
        ->whereNotNull('event_id')
        ->get();

        foreach($appoints as $app)
        {
            if(is_null($app->attendees))
            {
                $event = New GoogleCalendarController;
                $event = $event->getEvent($app->event_id);
                $event = $event->googleEvent;
                // dd($event);

                if($event->attendees)
                {
                    $emails = [];
                    foreach($event->attendees as $attendee)
                    {
                        array_push($emails, $attendee->email);
                    }
                    Call::where('id', $app->id)->update([
                        'hangoutLink' => $event->hangoutLink,
                        'attendees' => $emails
                    ]);
                }
            }
        }
        // dd($appoints);
        $appointments = Call::orderBy('id', 'DESC')
            ->where('contact','Yes')
            ->where('applicant', 'No')
            ->where('appointment', 'Yes')
            ->where(function ($query) {
                $query->where('user', Auth::user()->id)
                    ->orWhere('agent', Auth::user()->id);
            })
            ->get();
            // dd($appointments);
        return view('appointments.index', compact('appointments'));
    }

    public function view($id)
    {
        $customer = Customer::findorfail($id);
        $calls = Call::where('customer_id',$id)->orderBy('id','DESC')->get();        
        return view('appointments.details', compact('customer','calls'));
    }

    public function reappointcustomer($id)
    {                
        $call = Call::findorfail($id);
        $call->contact = 'No';
        $call->save();

        $customer = Customer::where('id',$call->customer_id)->first();
        $customer->contact = 'No';
        $customer->save();

        return redirect(route('appointments.index'))->with('success','User Ready For Contact');
        
    }

    public function applicantstore(Request $request)
    {
        $call = Call::where('customer_id', $request->customer_id)->latest()->first();
        $call->meet = $request->meet;

        if($request->put_application == 'Yes')
        {                
            $call->applicant = 'Yes';
            $call->Save();             
            return redirect()->route('applicant.index')->with('success','User Successfully Moved To Applicant');
        }
        elseif($request->put_application == 'Not Interested')
        {
            $call->Interested = 1;  
            $call->appointment = 'No';
            $call->Save();             
            return redirect()->route('appointments.index')->with('success','Client Not Interested');
        }
          
    }

    public function applicantindex()
    {              
        $applicants = Call::orderBy('id', 'DESC')
        ->where('applicant', 'Yes')
        ->where('appointment', 'Yes')
        ->where('final','No')
        ->where('sold',Null)
        ->where(function ($query)
        {
            $query->where('user', Auth::user()->id)
                ->orWhere('agent', Auth::user()->id);
        })
        ->get();                               
        return view('applicant.index',compact('applicants'));
        
    }

    public function applicanttocustomer(Request $request, $id)
    {
        $customer = Call::where('customer_id',$id)->first();

        if($request->customer_approve == 'Yes')
        {
            $request->validate([
                'company_name' => 'nullable',
                'policy_issued_date' => 'required',
                'policy_number' => 'required'
            ]);

            $customer->final = 'Yes';
            $customer->sold = 'Yes';       
            $customer->save();

            $customer= Customer::findorfail($id);
            $customer->company_name = $request->company_name;
            $customer->policy_number = $request->policy_number;
            $customer->policy_issued_date = $request->policy_issued_date;
            $customer->monthly_premium = $request->monthly_premium;
            $customer->contract_rate = $request->contract_rate;
            $customer->commission_rate = $request->commission_rate;
            $customer->benefit_amount = $request->benefit_amount;
            $customer->Status = 'Active';
            $customer->save();

            $final = new FinalCustomer();
            $final->user_id = Auth::user()->id;
            $final->customer_id = $id;
            $final->product_id = 1;
            $final->company_name = $request->company_name;
            $final->policy_number = $request->policy_number;
            $final->policy_issued_date = $request->policy_issued_date;
            $final->monthly_premium = $request->monthly_premium;
            $final->contract_rate = $request->contract_rate;
            $final->commission_rate = $request->commission_rate;
            $final->benefit_amount = $request->benefit_amount;
            $final->save();
            
            return redirect()->route('customer.index')->with('success', 'Your Applicant Was Added to The Customer');
        }

        if($request->customer_approve == 'No')
        {
            $customer = Call::where('customer_id',$id)->first();
            $customer->sold = 'No';
            $customer->save();

            return redirect()->route('call.index')->with('success', 'Applicant Not Approved The Application Make A New Call');
        }              
    }

    public function applicantview($id)
    {
        $customer = Customer::findorfail($id);
        $calls = Call::where('customer_id',$id)->orderBy('id','DESC')->get();        
        return view('applicant.view', compact('customer', 'calls'));
    }
}
