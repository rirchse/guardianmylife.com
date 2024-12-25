<?php

namespace App\Http\Controllers;

use App\Models\AgentleadsAssign;
use App\Models\Call;
use App\Models\Customer;
use App\Models\EmployeeLeadAssign;
use App\Models\FinalCustomer;
use App\Models\Leads;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class CustomerController extends Controller
{
    public function index2()
    {
        // if(Auth::user()->role == 1){
        //     $customers = Customer::paginate('20');            
        // }
        if(Auth::user()->role == 2)
        {            
            // Assuming $users is the collection of users obtained earlier
            $leads = Leads::where('user_id', Auth::user()->id)->get();
            if ($leads)
            {
                $leadsUserId = $leads->pluck('id'); 
                $customers = Customer::where('contact','No')->whereIn('leads_id', $leadsUserId)->where('assigned_to',0)->orderBy('id', 'DESC')->paginate('25');
            } else {
                $customers = collect();
            }             
        }
        else
        {
            $customers = Customer::where('assigned_to', Auth::user()->id)->orderBy('id', 'DESC')->paginate('25');
        }

        // dd($customer);
        
        return view('customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::leftJoin('users', 'users.id', 'customers.lead_owner')
        ->select('customers.*', 'users.name')
        ->findorfail($id);
        $calls = Call::where('customer_id',$id)->orderBy('id','DESC')->get();
        
        if($customer->Mobile)
            $customer->Mobile = $this->formatPhoneNumber( $customer->Mobile );
        
        if($customer->Work)
            $customer->Work = $this->formatPhoneNumber( $customer->Work );
        
        if($customer->home)
            $customer->home = $this->formatPhoneNumber( $customer->home );
        
        return view('customers.view', compact('customer','calls'));
    }
    
    public function formatPhoneNumber($phoneNumber) {
      $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
    
        if(strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);
    
            $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);
    
            $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);
    
            $phoneNumber = $nextThree.'-'.$lastFour;
        }
    
        return $phoneNumber;
    }

    public function edit($id)
    {
        $user = Customer::findorfail($id);        
        return view('customers.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_type' => 'required',
        ]);

        $data = $request->all();
        
        // dd($custs);

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }
        
        if(isset($data['_method']))
        {
            unset($data['_method']);
        }
        
        if(!isset($data['mortgage']))
        {
            $data['mortgage'] = NULL;
        }

        if(!isset($data['married']))
        {
            $data['married'] = NULL;
        }

        $data['updated_by'] = auth()->user()->id;
        $data['updated_at'] = date('Y-m-d h:i:s');

        $premium = [
            'policy_number' => $data['policy_number'],
            'monthly_premium' => $data['monthly_premium'],
            'contract_rate' => $data['contract_rate'],
            'commission_rate' => $data['commission_rate']
        ];

        try {
            Customer::where('id', $id)->update($data);
            FinalCustomer::where('customer_id', $id)->update($premium);
        }
        catch(Exception $e)
        {
            $e.getMessage();
        }

        $user = Customer::findorfail($id);

        if($user->Status == 'Active')
        {
            return redirect()->route('finalcustomers.index')->with('success', 'Customer Data successfully Updated.');      
        }

        return redirect()->route('customer.show', $user->id)->with('success', 'User Data successfully Updated.');
        // echo '<script>window.close();</script>';
        // return redirect()->route('customer.show', $user->id)->with('success', '');
    }

    /** view all customers */
    public function index()
    {
        $user = Auth::user()->id;
        $customers = FinalCustomer::leftJoin('customers', 'customers.id', 'final_customers.customer_id')
        ->leftJoin('users', 'users.id', 'final_customers.user_id');

        if(Auth::user()->role == 2)
        {
            $customers = $customers->where('customers.lead_owner', $user);
        }
        
        if(Auth::user()->role == 3)
        {
            $customers = $customers->where('final_customers.user_id', $user);
        }

        $customers = $customers->orderBy('final_customers.id', 'DESC')
        ->select('final_customers.*', 'customers.first_name', 'customers.last_name', 'customers.email', 'customers.mobile', 'users.name', 'customers.assigned_to')
        ->paginate('20');
        // dd(Auth::user());
                                
        return view('customers.index', compact('customers'));
    }

    /** requested contact list  */
    public function contact()
    {
        $contacts = Contact::paginate(25);
        return view('customers.contact', compact('contacts'));
    }
}
