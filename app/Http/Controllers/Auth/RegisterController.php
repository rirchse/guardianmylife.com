<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SourceCtrl;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'agent_id' => Auth::user()->id,
        ]);
    }

    public function referrer($code)
    {
        $referrer = Customer::where('referrer_code', $code)
        ->select('id', 'first_name', 'last_name', 'referrer_code')
        ->first();
        Session::put('_referrer', $referrer);
        return redirect('/signup');
    }

    
    public function signup()
    {
        return view('auth.register');
    }

    public function signupStore(Request $request)
    {
        $source = new SourceCtrl;

        /** data validation */
        $passValidate = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name'  => 'required|string|max:32',
            'email'      => 'required|string|email|max:32|unique:customers',
            'mobile'     => 'required|string|max:20',
            'street_address' => 'nullable|string',
            'date_of_birth' => 'required|string|max:18',
            'city'      => 'required|string|max:50',
            'state'     => 'required|string|max:50',
            'beneficiary'   => 'required|string|max:50',
            'insurance_amount'  => 'required|string',
        ]);

        $data = $request->all();
        $email = $data['email'];

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        if(isset($data['insurance_amount']))
        {
            $data['insurance_amount'] = str_replace(['$',','], '', $data['insurance_amount']);
        }

        $referrer = Session::get('_referrer');
        if($referrer)
        {
            $data['referrer_id'] = $referrer->id;
            $data['lead_owner']  = $referrer->lead_owner;
        }

        $data['referrer_code'] = $source->code();
        $data['token'] = strtoupper(md5($data['email']));

        if(Session::get('_agent'))
        {
            $data['agent_id'] = Session::get('_agent')->id;
        }

        try{
            Customer::insert($data);
            Session::forget('_referrer');
        }
        catch(\E $e)
        {
            return $e;
        }

        if(Session::get('_agent'))
        {
            $data['agent'] = Session::get('_agent');
            Session::forget('_agent');
        }

        /** send email */
        $data = [
            'email_to' => $data['email'],
            'subject' => 'Email Verification',
            'banner' => 'img/email_verification.jpg',
            'email_title' => 'Hello '.$data['first_name'].' '.$data['last_name'],
            'email_body' => 'Please Click on the link to verify your email <a target="_blank" href="'.$source->host().'/email_verify/'.$data['token'].'">Verify</a>',
            'logo' => 'img/logo.png'
        ];

        $mail = new EmailController;
        $mail->sendMail($data);

        Session::flash('success', 'Thank you for join with us. We have sent you a verification email to '.$email.'. Please check your email and confirm verification.');
        return redirect('/');
    }

    public function emailVerify($token)
    {
        $this->validator([
            'token' => 'required | string | max:255'
        ]);

        $customer = Customer::where('token', $token)->first();
        if($customer)
        {
            /** update token as null */
            Customer::where('token', $token)->update(['token' => NULL]);

            $referrer = Customer::find($customer->referrer_id);
            if($referrer)
            {
                $ref_count = 0;
                $ref_count = $referrer->ref_user_count + 1;

                Customer::where('id', $customer->referrer_id)->update(['ref_user_count' => $ref_count]);
            }

            Session::flash('success', 'Thank you for verifying your email.  A member of the Guardian My Life Team will contact you soon to go over the information you have sent us.');
        }
        
        return redirect()->route('homepage');
    }
    
    /** Agent Signup */
    public function agentSignup(Request $request)
    {
        /** data validation */
        $validate = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'required|string|max:18',
            'address' => 'nullable|string',
            'city'      => 'required|string|max:50',
            'state'     => 'required|string|max:50',
            'license'   => 'required|string|max:50',
            'team_manage'  => 'required|string|max:100',
            'how_find'  => 'required|string|max:100',
            'your_hope' => 'required|string|max:1000',
        ]);

        $data = $request->all();
        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        if(Session::get('_agent'))
        {
            $data['agent_id'] = Session::get('_agent')->id;
            $data['referrer_id'] = Session::get('_agent_id');
        }

        $data['signup_by'] = 'Web';

        try{
            User::insert($data);
        }
        catch(\E $e)
        {
            return $e;
        }

        if(Session::get('_agent'))
        {
            Session::forget('_agent');
        }

        Session::flash('success', 'Thank you for your interest to join our team.  A member from our recruitment team will contact you soon.');
        return redirect()->route('homepage');
    }

    /** store user requsest contact information */
    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users',
            'phone'   => 'required|string|max:18',
            'city'    => 'required|string|max:50',
            'state'   => 'required|string|max:50',
            'message' => 'required|string|max:1000',
        ]);

        $data = $request->all();

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        try{
            Contact::insert($data);
        }catch(\E $e)
        {
            return $e;
        }

        Session::flash('success', 'Thank you for contact with us!');

        return redirect()->back();
        // return redirect()->route('homepage');

    }

    /** ajax request */
    public function checkUsername($username)
    {
        $data = User::where('username', $username)->first();
        if($data)
        {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 200);
    }
}
