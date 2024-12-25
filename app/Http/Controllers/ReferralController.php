<?php
namespace App\Http\Controllers;

use App\Models\Customer;

class ReferralController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $referrals = Customer::whereNotNull('referrer_code')->get();
    return view('referrals.index', compact('referrals'));
  }

  public function referredCustomer($id)
  {
    $referrals = Customer::whereNotNull('customers.referrer_id');
    
    if($id != 'all' && is_numeric($id))
    {
      $referrals = $referrals->where('customers.referrer_id', $id);
    }

    $referrals = $referrals->leftJoin('customers as refs', 'customers.referrer_id', 'refs.id')
    ->select(
      'customers.id',
      'customers.first_name',
      'customers.last_name', 
      'customers.email', 
      'customers.mobile',
      'customers.referrer_code',
      'customers.created_at', 
      'refs.first_name as ref_first_name', 
      'refs.last_name as ref_last_name')
    ->get();

    // dd($referrals);

    return view('referrals.referred_customers', compact('referrals'));
  }
}