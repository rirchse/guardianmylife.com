<?php
namespace App\Http\Controllers;

use App\Models\Customer;

class SourceCtrl extends Controller
{
  public static function dtformat($date)
  {
    if($date)
    {
      return date('M d Y h:i:s', strtotime($date));
    }
  }

  public static function dformat($date)
  {
    if($date)
    {
      return date('M d Y', strtotime($date));
    }
  }

  public function ageCalc($date)
  {
    $_age = floor((time() - strtotime($date)) / 31556926);
    return $_age;
  }

  public function phoneFormat($data)
  {
    if($data)
    {
      return $result = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $data);
    }
  }

  // date format according to db
  function dbdf($date)
  {
    if($date)
    {
      return date('Y-m-d', strtotime($date));
    }
  }

  /** generate uniq referrer code */
  public function code()
  {
    $code = 100123;
    $customer = Customer::max('referrer_code');
    if($customer)
    {
      $code = $customer+1;
    }
    return $code;
  }

  public function host()
  {
    $protocol = isset($_SERVER['HTTPS'])?'https://':'http://';
    $host = $protocol.$_SERVER['HTTP_HOST'];
    return $host;
  }
}