<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SourceCtrl;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
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
    public function __construct()
    {
        $this->middleware('guest');
    }

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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'agent_id' => Auth::user()->id,
        ]);
    }

    public function referrer($code)
    {
        $referrer = Customer::where('referrer_code')->first();
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
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();
        $email = $data['email'];

        if(isset($data['_token']))
        {
            unset($data['_token']);
        }

        $referrer = Session::get('_referrer');
        if($referrer)
        {
            $data['referrer_id'] = $referrer->id;
        }

        $data['referrer_code'] = $source->code();
        $data['token'] = strtoupper(md5($data['email']));

        // dd($data);

        try{
            Customer::insert($data);
            Session::forget('_referrer');
        }
        catch(\E $e)
        {
            return $e;
        }

        /** send email */
        $data = [
            'email_to' => $data['email'],
            'subject' => 'Email Verification',
            'banner' => 'img/logo.png',
            'email_title' => 'Hello '.$data['first_name'].' '.$data['last_name'],
            'email_body' => 'Please onclicking the link verify your email <a target="_blank" href="'.$source->host().'/email_verify/'.$data['token'].'">Verify</a>',
            'logo' => 'img/logo.png'
        ];

        $mail = new EmailController;
        $mail->sendMail($data);

        Session::flash('success', 'Thank you register with us. We have sent you a verification to '.$email.'. Please check your email and confirm verification.');
        return redirect('/');
    }

    public function emailVerify($token)
    {
        return Validator::make($data, [
            'token' => ['required', 'string', 'max:255']
        ]);

        $customer = Customer::where('token', $token)->first();
        if($customer)
        {
            Customer::where('token')->update(['token' => null]);
            Session::flash('success', 'Thank you for email verification. Guardiamylife agent team will contact to you very soon for further information.');
        }
        
        return redirect()->route('/');
    }
}
