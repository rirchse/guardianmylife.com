<?php

namespace App\Http\Controllers;

use App\Models\AgentleadsAssign;
use App\Models\Customer;
use App\Models\EmployeeLeadAssign;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class LeadsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Customer::leftJoin('users', 'users.id', 'customers.created_by')
        ->leftJoin('users as users2', 'users2.id', 'customers.assigned_to')
        ->leftJoin('calls', 'customers.id', 'calls.customer_id')
        ->OrderBy('customers.id', 'DESC');

        if($user->role == 3)
        {
            $query = $query->where('customers.assigned_to', $user->id);
        }
        elseif($user->role == 2)
        {
            $query = $query->where('customers.assigned_to', 0)->where('customers.lead_owner', Auth::id());
        }

        $leads = $query->where('calls.customer_id', NULL)
        ->where('customers.referrer_id', NULL)
        ->select('customers.*', 'users.name', 'users2.name as member_name', 'calls.customer_id')->get();

        return view('leads.index', compact('leads'));
    }
    
    public function leadUpload()
    {
        if(Auth::user()->role == 1)
        {
            $leads = Leads::latest()->paginate(10);
        }
        else
        {
            $leads = Leads::orderBy('id','DESC')->where('user_id',Auth::user()->id)->get();
        }
        
        return view('leads.upload', compact('leads'));
    }


    /** upload leads from file .xls, .xlsx, .csv */
    public function uploadStore(Request $request)
    {
        $source = New SourceCtrl;

        $request->validate([
            'lead_type'     => 'required',
            'purchase_date' => 'required',
            'num_lead'      => 'nullable',
            'amount_paid'   => 'required',
            'cost_per_lead' => 'required',
            // 'template_type' => 'required',
            'fileURL' => 'required|mimes:xls,xlsx,csv',
        ]);

        if ($request->hasFile('fileURL')) 
        {
            $lead_count = 0;

            $originalName = $request->file('fileURL')->getClientOriginalName();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('fileURL')->getClientOriginalExtension();
    
            if ($extension == 'csv')
            {
                $reader = new Csv();
            }
            elseif ($extension == 'xlsx')
            {
                $reader = new Xlsx();
            }
            else
            {
                $reader = new Xls();
            }
            
            $filePath = $request->file('fileURL')->getRealPath();
            
            $spreadsheet = $reader->load($filePath);            
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            // dd($sheetData);

            /** check lead exist in database */
            if(count($sheetData) > 0)
            {
                for ($i = 1; $i < count($sheetData); $i++) 
                {
                    if(isset($sheetData[$i][7]))
                    {
                        $db_lead = Customer::where('email', $sheetData[$i][7])->select('email')->first();

                        if(is_null($db_lead))
                        {
                            $lead_count += 1;
                        }
                    }
                }
            }            
                        
            if (!empty($sheetData) && $lead_count > 0)
            {
                // create a object for lead
                $leads = new Leads();
                $leads->name = $fileName;
                $leads->user_id = Auth::user()->id;
                $leads->type = $request->input('lead_type');
                $leads->sub_type = $request->input('lead_sub_type');
                $leads->purchase_date = $source->dbdf($request->input('purchase_date'));
                $leads->no_of_leads = $lead_count;
                // $leads->no_of_leads = $request->input('num_lead');
                $leads->remaining = $request->input('num_lead');
                $leads->amount_paid = $request->input('amount_paid');
                $leads->cost_per_lead = $request->input('cost_per_lead');
                $leads->users_count = Auth::user()->id;
                $leads->save();
                
                for ($i = 1; $i < count($sheetData); $i++) 
                {
                    $db_lead = Customer::where('email', $sheetData[$i][7])->select('email')->first();

                    $inData = array();

                    if( isset($sheetData[$i][7]) )
                    {
                        if(is_null($db_lead))
                        {
                            $inData['leads_id'] = $leads->id;
                            $inData['current_status'] = 1;
                            $inData['lead_type'] = $leads->type;
                            $inData['lead_date'] = $source->dbdf($sheetData[$i][1]);
                            $inData['first_name'] = $sheetData[$i][2];
                            $inData['last_name'] = $sheetData[$i][3];
                            $inData['home'] = $source->phoneFormat($sheetData[$i][4]);
                            $inData['mobile'] = $source->phoneFormat($sheetData[$i][5]);
                            $inData['work'] = $source->phoneFormat($sheetData[$i][6]);
                            $inData['email'] = $sheetData[$i][7];
                            $inData['company_name'] = $sheetData[$i][8];
                            $inData['street_address'] = $sheetData[$i][9];
                            $inData['city'] = $sheetData[$i][10];
                            $inData['state'] = $sheetData[$i][11];
                            $inData['zip'] = $sheetData[$i][12];
                            $inData['date_of_birth'] = $source->dbdf($sheetData[$i][13]);
                            $inData['age'] = $sheetData[$i][14];
                            $inData['mortgage'] = $sheetData[$i][15];
                            $inData['lender'] = $sheetData[$i][16];
                            $inData['mortgage_date'] = $source->dbdf($sheetData[$i][17]); 
                            $inData['mortgage_amount'] = $sheetData[$i][18];
                            $inData['mortgage_balance'] = $sheetData[$i][19];
                            $inData['policy_number'] = $sheetData[$i][20];
                            $inData['policy_issued_date'] = $source->dbdf($sheetData[$i][21]);
                            $inData['married'] = $sheetData[$i][22];
                            $inData['spouse_name'] = $sheetData[$i][23];
                            $inData['spouse_birth_date'] = $source->dbdf($sheetData[$i][24]);
                            $inData['marriage_date'] = $source->dbdf($sheetData[$i][25]);
                            $inData['full_name'] = $sheetData[$i][26];
                            $inData['contact_title'] = $sheetData[$i][27];
                            $inData['website'] = $sheetData[$i][28];

                            $inData['lead_owner'] = Auth::user()->id;
                            $inData['created_by'] = Auth::user()->id;
                    
                            Customer::insert($inData);
                            $lead_count += 1;
                        }
                    }
                }

                return redirect()->back()->with('success','Leads Enter Successfully');
            }

            return redirect()->back()->with('error','Leads not available for entry.');
        }
    }
  

    public function employeeleadsassign()
    {
        $leads = Leads::where('user_id', Auth::user()->id)->where('available','Yes')->get();

        if(!$leads)
        {
            $leads = collect();
        }

        $users = User::where('role', 3)->where('agent_id', Auth::user()->id)->get();

        return view('leads.employeeleadassign',compact('leads','users'));
    }
   

    public function storeemployeeleadsassign(Request $request)
    {
        if($request->available_leads < $request->leads_given)
        {
            return redirect()->back()->with('error','Assigned leads must not be max than available leads.');
        }

        // dd($request->all());
        $leads = Customer::leftJoin('calls', 'calls.customer_id', 'customers.id')
        ->whereNull('calls.customer_id')
        ->where('customers.lead_type', $request->lead_type)
        ->where('customers.assigned_to', 0)
        ->limit($request->leads_given)
        ->orderBy('customers.id', 'DESC')
        ->select('customers.id', 'calls.customer_id')
        ->get();

        // dd($leads);

        foreach($leads as $lead)
        {
            $lead->assigned_to = $request->employee_id;
            $lead->update();
        }

        $assign = new EmployeeLeadAssign();
        $assign->employee_id = $request->employee_id;    
        $assign->lead_id = 0;    
        $assign->no_of_leads = $request->leads_given;
        $assign->assigned_by = Auth::user()->id;
        $assign->save();
                
        return redirect()->back()->with('success','Leads Assign Successfully');
    }

    /** ajax call */
    public function getLeadRecord(Request $request)
    {
        // Retrieve the lead record based on the leadId
        $lead = Customer::leftJoin('calls', 'calls.customer_id', 'customers.id')
        ->where('customers.lead_type', 'like', '%'.$request->lead_type.'%')
        ->where('customers.assigned_to', 0)
        ->whereNull('calls.customer_id')
        ->orderBy('customers.id', 'DESC')
        ->select('customers.id', 'calls.customer_id')
        ->get();
        // dd($lead);

        // Perform any necessary calculations to determine the number of leads
        // $availableLeads = $lead;
        $availableLeads = count($lead);
        // $availableLeads = $lead->remaining;

        // Return the response as JSON
        return response()->json(['available_leads' => $availableLeads]);
    }

    public function delete($id)
    {
        $lead = Leads::findorfail($id);
        $lead->delete();
        Customer::where('leads_id', $id)->delete();  
        return redirect()->back()->with('success','Leads Deleted Successfully');
    }

    public function show($id)
    {
        $customers = Customer::leftJoin('users', 'users.id', 'customers.lead_owner')
        ->leftJoin('calls', 'calls.customer_id', 'customers.id')
        ->where('customers.leads_id', $id)
        ->select('customers.*', 'users.name', 'calls.customer_id')
        ->paginate('25');
        return view('leads.view', compact('customers'));
    }

    public function edit($id)
    {
        $lead = Customer::find($id);
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_type' => 'required',
        ]);

        $data = $request->all();

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

        // dd($data);

        try {
            Customer::where('id', $id)->update($data);
        }
        catch(Exception $e)
        {
            $e.getMessage();
        }
       
        return redirect()->back()->with('success','The lead successfully updated.');
    }


    /** Lead: single entry  */
    public function create()
    {
        $leads = Customer::leftJoin('users', 'users.id', 'customers.created_by')
        ->OrderBy('customers.id', 'DESC')
        ->select('customers.*', 'users.name')
        ->limit(10)->get();
        return view('leads.create', compact('leads'));
    }

    /** Lead: store single */
    public function store(Request $request)
    {
        $request->validate([
            'lead_type' => 'required',
        ]);

        $data = $request->all();

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        $data['created_by'] = auth()->user()->id;
        $data['lead_owner'] = auth()->user()->id;
        $data['created_at'] = date('Y-m-d h:i:s');
        // dd($data);

        if(!is_null(Customer::where('email', $data['email'])->first()))
        {
            return redirect()->back()->with('error', 'This lead already exists.');
        }

        try {
            Customer::insert($data);
        }
        catch(Exception $e)
        {
            $e.getMessage();
        }
       
        return redirect()->back()->with('success','The single lead successfully Created.');
    }

    /** Lead: delete */
    public function deleteSingle($id)
    {
        Customer::findorfail($id)->delete();
        return redirect()->back()->with('success','The single lead successfully deleted.');
    }

    public function destroy($id)
    {
        $customers = Customer::leftJoin('calls', 'calls.customer_id', 'customers.id')
        ->where('customers.leads_id', $id)
        ->where('calls.customer_id', NULL)
        ->select('calls.customer_id')->delete();

        $leads = Customer::where('leads_id', $id)->get();
        if(count($leads) == 0)
        {
            $lead = Leads::find($id);
            $lead->delete();
        }

        return back()->with('success', 'The leads deleted successfully.');
    }
}
