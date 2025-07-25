<?php

namespace App\Http\Controllers;

use App\Models\AdminLogs;
use App\Models\Call;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\FinalCustomer;
use App\Models\Leads;
use App\Models\Remainder;
use App\Models\User;
use App\Models\Role;
use App\Models\WorkingDayHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Spatie\LaravelIgnition\FlareMiddleware\AddLogs;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::where('status', 1)->get();
        $customers = FinalCustomer::leftJoin('customers', 'customers.id', 'final_customers.customer_id')
        ->leftJoin('users', 'users.email', 'customers.email')
        ->whereNotIn('customers.email', User::select('email')->get()->toArray())
        ->orderBy('final_customers.id', 'DESC')
        ->select('customers.email', 'customers.first_name', 'customers.last_name')
        ->get();

        if(Auth::user()->role == 1)
        {
            $users = User::leftJoin('roles', 'roles.id', 'users.role')
            ->where('users.role', 1)->orWhere('users.role', 2)
            ->select('users.*', 'roles.name as role_name')
            ->paginate(10);
        }
        else
        {
            $users = User::leftJoin('roles', 'roles.id', 'users.role')
            ->where('users.agent_id', Auth::user()->id)->orWhere('users.id',Auth::user()->id)
            ->select('users.*', 'roles.name as role_name')
            ->paginate(10);
        }

        return view('users.index', compact('roles', 'users', 'customers'));
    }

    public function useredit($id)
    {
        $roles = Role::where('status', 1)->get();
        $user = User::findorfail($id);
        return view('users.edit', compact('roles', 'user'));
    }

    public function userupdate(Request $request, $id)
    {        
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],          
        ]);

        $user = User::findorfail($id);
        $user->role = $request->role;
        $user->name = $request->full_name;
        $user->email = $request->email;       
        
        $user->save();
        return redirect()->back()->with('success','User Updated Successfully');
    }

    public function forgetPassword()
    {
        if(Auth::user()->role == 1){  
            $users = User::all();
            }else{
                $users = User::where('agent_id',Auth::user()->id)->get();
            }
        return view('users.forgetpassword',compact('users'));
    }

    public function verifyemail(Request $request)
    {                
        $exists = User::select('id')->where('email', $request->email)
        // ->where('name', $request->username)
        ->first();        
        if ($exists != null) {            
        return view('users.emailforget',compact('exists'));
        } else {
      return redirect()->back()->with('error','Credentials not matched');
        }
    }
   
    public function authresetPassword(Request $request)
    {        
        $request->validate([          
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->to('/')->with('success', 'Password Updated Successfully');
    }
    
    public function resetPassword(Request $request)
    {        
        // Validate the form data
        $request->validate([          
            'new_password' => 'required|min:8',
            'confirm' => 'required|same:new_password',
        ]);  
        // dd($request->all());  

        $user = User::findorfail($request->user_id);                             
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect the user with a success message
        return redirect()->route('user.forgetpassword')->with('success', 'Password reset successfully');
    }

    /** this method using to show report */
    public function dailysumhours(Request $request)
    {
        $userId = $from = $to = $singleuser = $totalWorkingHours = null;
        $workinghours = []; 

        if(Auth::user()->role == 1)
        {
            $users =  $users = User::where('role', 1)->orwhere('role', 2)->get();
            $user_name = User::select('name')->find($request->user_id);
        }
        else
        {
            $users = User::where('id', Auth::user()->id)->orwhere('agent_id',Auth::user()->id)->orwhere('super_agent', Auth::user()->id)->get();
            $user_name = Auth::user()->name;
        }

        if($request->from == null)
        {
            $from = date('Y-m-d', strtotime(date('Y-m-d')."-1 month", ));
            $to = date('Y-m-d');
            $userId = Auth::user()->id;
        }
        else
        {
            $from = $request->input('from');
            $to = $request->input('to');
            $userId = $request->input('user_id');  
            $user = User::findorfail($userId);
        }

            
        if(Auth::user()->role == 1)
        {                         
            $finalUser = $request->input('user_id');
        }
        else
        {
            $finalUser = Auth::user()->id;
        }

        
        try {
            
            $detailuser = User::where('id', $finalUser)
            ->orWhere('agent_id', $finalUser)
            ->pluck('id')
            ->toArray();                
            
            $totalWorkingHours = DB::table('working_day_hours')
                ->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(workingHours))) AS total')
                ->where('date', '>=', $from)
                ->where('date', '<=', $to)
                ->whereIn('user_id', $detailuser)
                ->value('total');
        }
        catch (\Exception $e)
        {             
            Log::error($e->getMessage());
            $totalWorkingHours = 0;
        }

        try {
            $totalcallingHours = Call::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(call_time))) AS total_time')
                ->whereRaw('DATE(created_at) >= ?', [$from])
                ->whereRaw('DATE(created_at) <= ?', [$to])
                ->whereRaw("(agent = $userId OR user = $userId)")
                ->value('total_time');
        }
        catch (\Exception $e)
        {             
            Log::error($e->getMessage());
            $totalcallingHours = 0;
        }        
        
        $detailuser = User::where('id', $finalUser)
        ->orWhere('agent_id', $finalUser)
        ->pluck('id')
        ->toArray();
        
        $remainders = Remainder::whereRaw('DATE(created_at) >= ?', [$from])
            ->whereRaw('DATE(created_at) <= ?', [$to])            
            ->whereIn('user_id', $detailuser)
            ->count();

        //query all calls
        $calls = Call::whereRaw('DATE(created_at) >= ?', [$from])
        ->whereRaw('DATE(created_at) <= ?', [$to])
        ->whereIn('user', $detailuser)
        ->get();

        // all default data query
        $appoinements = $yes = $no = $wrong = $sold = $disconnect = $interested = $appointment_sat = 0;

            foreach($calls as $call)
            {
                if($call->appointment == 'Yes')
                {
                    $appoinements ++;
                }

                if($call->contact == 'Yes')
                {
                    $yes ++;
                }

                if($call->contact == 'No')
                {
                    $no ++;
                }

                if($call->contact == 'Wrong No')
                {
                    $wrong ++;
                }

                if($call->sold == 'Yes')
                {
                    $sold ++;
                }

                if($call->contact == 'Disconnect No')
                {
                    $disconnect ++;
                }

                if($call->Interested == '1')
                {
                    $interested ++;
                }

                if($call->meet == 'Yes')
                {
                    $appointment_sat ++;
                }
            }
            
            $calls = $yes + $no + $wrong + $remainders + $disconnect + $interested;
            $average_call_time = null;

            if ($yes > 0)
            {
                // Convert total calling hours to seconds
                $totalSeconds = strtotime($totalcallingHours) - strtotime('00:00:00');
                
                // Calculate the average call time in seconds
                $averageSeconds = $totalSeconds / $yes;
                
                // Convert average call time back to HH:MM:SS format
                $average_call_time = gmdate('H:i:s', $averageSeconds);
            } 

            $appointment_ratio = 0;
            if ($yes > 0 && $appoinements > 0)
            {
            $appointment_ratio = $appoinements / $yes * 100;
            $appointment_ratio = number_format($appointment_ratio, 2);
            }
            
            $sales_ratio = 0;
            if ($appoinements > 0)
            {
                $sales_ratio = $sold / $appoinements * 100;
                $sales_ratio = number_format($sales_ratio, 2);
            }
            
            $appointment_sat_ratio = 0;
            if ($appointment_sat > 0 && $appoinements > 0)
            {
                $appointment_sat_ratio = $appointment_sat * 100 / $appoinements;
                $appointment_sat_ratio = number_format($appointment_sat_ratio, 2);
            }
            
            $leads = Leads::whereRaw('DATE(created_at) >= ?', [$from])
            ->whereRaw('DATE(created_at) <= ?', [$to])
            ->whereIn('user_id', $detailuser)
            ->sum('no_of_leads');

            $cost = Leads::whereRaw('DATE(purchase_date) >= ?', [$from])
            ->whereRaw('DATE(purchase_date) <= ?', [$to])
            ->whereIn('user_id', $detailuser)
            ->sum('amount_paid');
                        
            if($cost > 0)
            {
              $cost_per_lead = $cost/ $leads;
            }
            else
            {
                $cost_per_lead = 0;
            }
                    

            $ratio = 0;
            if($appointment_sat > 0)
            {
                $ratio = ($sold / $appointment_sat) * 100;
                $ratio = round($ratio);  // Round to three decimal places
            }
            else
            {
                $ratio = 0;
            }

            $budget = Expense::whereRaw('DATE(expense_date) >= ?', [$from])
                ->whereRaw('DATE(expense_date) <= ?', [$to])
                ->whereIn('user_id', $detailuser)
                ->sum('amount');

            $balance =  $budget - $cost;   

            $customers = FinalCustomer::whereRaw('DATE(created_at) >= ?', [$from])
                ->whereRaw('DATE(created_at) <= ?', [$to])
                ->whereIn('user_id', $detailuser)->get();
               
            $totalCommissionPayment = 0;
            $totalBalanceDueLater = 0;
            $customerMonthlyPremium = 0;    
            $annualCustomerPayment = 0;

            foreach ($customers as $customer)
            {
                // Assuming you have the customerMonthlyPremium, contractRate, and commissionRate
                // retrieved from the $customer object or related table
                if($customer->monthly_premium)
                    $customerMonthlyPremium += $customer->monthly_premium; 
                // Replace with the actual field name
                
                $contractRate = $customer->contract_rate /100; // Replace with the actual field name
                $commissionRate = $customer->commission_rate /100; // Replace with the actual field name
        
                // Calculate the commission payments for the customer
                    // $customerMonthlyPremium += $customer->monthly_premium; // Replace with the actual field name
                $annualCustomerPayment = $customerMonthlyPremium * 12;
                $contractRatePayment = $annualCustomerPayment * $contractRate;
                $commissionPayment = $contractRatePayment * $commissionRate;
                $balanceDueLater = $contractRatePayment - $commissionPayment;
        
                // Add commission and balance due later to the totals
                $totalCommissionPayment += $commissionPayment;
                $totalBalanceDueLater += $balanceDueLater;
            }
        
            $customerable = null;
            $customerable = DB::select("SELECT concat(b.first_name, ' ', last_name) as name, a.monthly_premium as monthly, a.monthly_premium*12 as annual,
            a.contract_rate, (a.monthly_premium*12)*a.contract_rate/100 as amount, a.commission_rate,
            ((a.monthly_premium*12)*a.contract_rate/100)*a.commission_rate/100 as amount2,
            a.policy_number, a.company_name, c.name as Lead_Owner, a.benefit_amount
                                        
            FROM `final_customers` a LEFT JOIN customers b ON a.customer_id = b.id LEFT JOIN calls d ON b.id = d.customer_id AND d.appointment = 'Yes' LEFT JOIN users c ON c.id = d.user
            WHERE a.user_id = $userId AND DATE(a.created_at) >= '$from' AND DATE(a.created_at) <= '$to';");
                  
        return view('reports.index', compact('appointment_ratio','average_call_time', 'customerable', 'customerMonthlyPremium', 'annualCustomerPayment', 'sales_ratio', 'appointment_sat_ratio', 'totalcallingHours','totalCommissionPayment','appointment_sat','totalBalanceDueLater','users','user_name','totalWorkingHours','userId','singleuser','from','to','calls','appoinements','yes','no','wrong','disconnect','leads','cost_per_lead','cost','budget','balance','interested','remainders','sold','ratio'));
    
        // return view('reports.index',compact('users','totalWorkingHours','userId','singleuser','from','to'));
    }

    public function admindailysumhours(Request $request){        
        $from = $request->input('from');
        $to = $request->input('to');
        try {
            $totalWorkingHours = DB::table('working_day_hours')
                ->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(workingHours))) AS total')
                ->where('date', '>=', $from)
                ->where('date', '<=', $to)
                ->where('user_id', Auth::user()->id)
                ->value('total');
                // dd($totalWorkingHours);
                $workinghours = WorkingDayHour::where('date', '>=', $from)
                ->where('date', '<=', $to)->where('user_id', Auth::user()->id)->get(); 
        } catch (\Exception $e) {             
            Log::error($e->getMessage());
            $totalWorkingHours = 0;
            $workinghours = 0;
        }       
            return view('reports.admin-reports',compact('totalWorkingHours','workinghours','from','to'));

    }

    public function logs()
    {
        $currentDate = Carbon::now()->toDateString();
        // dd($currentDate);
        $logs = null;
        if(Auth::user()->role == 1){
        $logs = AdminLogs::where('role_id','!=',3)->whereDate('date', $currentDate)
        ->orderBy('id', 'DESC')
        ->get();
        }else{        
            $users = User::where('id', Auth::user()->id)
            ->orWhere('agent_id', Auth::user()->id)
            ->pluck('id')
            ->toArray();
            // dd($users);
                $logs = AdminLogs::whereIn('user_id', $users)->whereDate('date', $currentDate)->latest()->paginate(10);
            // $logs = AdminLogs::where('user_id',Auth::user()->id)->orwhere('user_id',Auth::user()->agent_id)->orderBy('id','DESC')->get();
        }
        return view('logs.index', compact('logs'));

    }

    public function store(Request $request)
    {           
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if(isset($request->role))
        {            
        $user->role = $request->role;
        }
        $user->agent_id = Auth::user()->id;
        if(Auth::user()->role == 2 && $request->role == 2)
        {
            $user->subagent = 1;
        }
        if(Auth::user()->role == 2 && Auth::user()->subagent != 0)
        {
            $user->super_agent = Auth::user()->agent_id;
        }
        else
        {
            $user->super_agent = Auth::user()->id;
        }
        $user->save();
        return redirect()->back()->with('success','User Added Successfully');
    }

    public function delete($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->back()->with('success','User Deleted Successfully');
    }

    public function edit($id)
    {
        // dd('hello');
        $user = Customer::findorfail($id);
        return view('customers.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {        
        $user = Customer::findorfail($id);
        $user->First_Name = $request->input('First_Name');
        $user->Last_Name = $request->input('Last_Name');
        $user->Date_of_Birth = $request->input('Date_of_Birth');
        $user->Age = $request->input('Age');
        $user->Email = $request->input('Email');
        $user->Home = $request->input('Home');
        $user->Mobile = $request->input('Mobile');
        $user->Work = $request->input('Work');
        $user->Mortgage_Amt = $request->input('Mortage_Amt');
        $user->Mortgage_Date = $request->input('Mortage_Date');
        $user->Lendor = $request->input('Lendor');
        $user->policy_number = $request->input('policy_number');
        $user->Street_Address = $request->input('Street_Address');
        $user->City = $request->input('City');
        $user->State = $request->input('State');
        $user->Zip = $request->input('Zip');
        $user->County = $request->input('Country');
        $user->company = $request->input('company');
        $user->save();
        
        return redirect()->back()->with('success', 'Customer Updated successfully');
    }


    /** other method agent sign up */
    public function agent()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            $users = User::orderBy('users.id', 'DESC')
            ->where('users.signup_by', 'Web')
            ->leftJoin('users as agent', 'agent.id', 'users.agent_id');
            if(Auth::user()->role == 2)
            {
                $users = $users->where('users.agent_id', Auth::id());
            }
            $users = $users->select('users.*', 'agent.name as agent_name')
            ->get();
            return view('users.agent', compact('users'));
        }
        
        Session::flash('error', 'Permission denied!');
        return back();
    }
}
