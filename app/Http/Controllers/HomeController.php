<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\User;
use App\Models\Customer;
use App\Models\FinalCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        // calls begining query
        $calls = Call::whereNotNull('customer_id');

        // leasds begining query
        $leads = Customer::leftJoin('calls', 'customers.id', 'calls.customer_id')
        ->whereNull('calls.customer_id');

        // appointments begining query
        $appointments = Call::where('appointment', 'Yes')->where('contact','Yes');

        // sold begining query
        $sold = FinalCustomer::leftJoin('customers', 'customers.id', 'final_customers.customer_id');

        if ($fromDate && $toDate) 
        {
            if (Auth::user()->role == 2)
            {
                $users = User::where('id', Auth::user()->id)
                ->orWhere('agent_id', Auth::user()->id)
                ->pluck('id')
                ->toArray();
                    
                $calls = $calls->whereIn('user', $users)
                ->whereRaw('DATE(created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(created_at) <= ?', [$toDate]);

                $leads = $leads->whereIn('user', $users)
                ->whereRaw('DATE(customers.created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(customers.created_at) <= ?', [$toDate]);

                $appointments = $appointments->where(function ($query) {
                    $query->where('user', Auth::user()->id)
                        ->orWhere('agent', Auth::user()->id);
                })
                ->whereRaw('DATE(created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(created_at) <= ?', [$toDate]);

                $sold = $sold->where('customers.lead_owner', $users)
                ->whereRaw('DATE(final_customers.created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(final_customers.created_at) <= ?', [$toDate]);
            }
            elseif (Auth::user()->role == 3)
            {
                $users = User::where('id', Auth::user()->id)
                ->pluck('id')
                ->toArray();
                    
                $calls = $calls->whereIn('user', $users)
                ->whereRaw('DATE(created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(created_at) <= ?', [$toDate]);

                $leads = $leads->where('customers.assigned_to', $users)
                ->whereRaw('DATE(customers.created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(customers.created_at) <= ?', [$toDate]);

                $appointments = $appointments->where('user', Auth::user()->id)
                ->where('applicant', 'No')
                ->whereRaw('DATE(created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(created_at) <= ?', [$toDate]);

                $sold = $sold->where('final_customers.user_id', Auth::user()->id)
                ->whereRaw('DATE(final_customers.created_at) >= ?', [$fromDate])
                ->whereRaw('DATE(final_customers.created_at) <= ?', [$toDate]);
            }
        }
        else 
        {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            if (Auth::user()->role == 2)
            {
                $users = User::where('id', Auth::user()->id)
                ->orWhere('agent_id', Auth::user()->id)
                ->pluck('id')
                ->toArray();
                    
                $calls = $calls->whereIn('user', $users)
                ->with('customer')->latest();

                $leads = $leads->whereIn('lead_owner', $users)
                ->where('customers.assigned_to', 0);

                $appointments = $appointments->whereIn('user', $users)
                ->where('applicant', 'No')
                ->where(function ($query) {
                    $query->where('user', Auth::user()->id)
                        ->orWhere('agent', Auth::user()->id);
                });

                $sold = $sold->whereIn('customers.lead_owner', $users);
            }
            elseif (Auth::user()->role == 3)
            {
                $users = User::where('id', Auth::user()->id)
                ->pluck('id')
                ->toArray();
                    
                $calls = $calls->whereIn('user', $users)
                ->with('customer')->latest();

                $leads = $leads->where('customers.assigned_to', Auth::user()->id);

                $appointments = $appointments->whereIn('user', $users)
                ->where('applicant', 'No')
                ->where(function ($query) {
                    $query->where('user', Auth::user()->id);
                });

                $sold = $sold->where('final_customers.user_id', Auth::user()->id);
            }
        }

        // calls executed query
        $calls = $calls->count();

        // leads executed query
        $leads = $leads->count();

        // appointments executed query
        $appointments = $appointments->count();

        // sold executed query
        $sold = $sold->count();
        

        return view('home', compact('calls', 'leads', 'appointments', 'sold'));
    }

}
