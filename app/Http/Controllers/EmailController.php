<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use View;
use Session;
use File;
use Mail;
use Image;

class EmailController extends Controller
{
  public function sendMail(array $data)
  {
    if(!isset($data['email_from']))
    {
      $data['email_from'] = 'no_reply@guardianmylife.com';
    }
    if(!isset($data['from_name']))
    {
      $data['from_name'] = 'GuardianMyLife.com';
    }

    Mail::send('mail.default', $data, function($message) use ($data)
    {
      $message->from($data['email_from'], $data['from_name']);
      $message->to($data['email_to']);
      $message->subject($data['subject']);
    });
  }
}