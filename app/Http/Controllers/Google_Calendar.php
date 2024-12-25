<?php
namespace App\Http\Controllers;
use Spatie\GoogleCalendar\GoogleCalendar;
use Carbon\Carbon;
use Google_Client;

use Google\Client as GoogleClient;

class Google_Calendar extends Controller
{

  public function getClient()
  {
    $client = new Google_Client();
    $client->setApplicationName('Web client 2');
    $client->setScopes([\Google_Service_Calendar::CALENDAR, \Google_Service_Calendar::CALENDAR_EVENTS]);
    $client->setAuthConfig(storage_path('keys/client_secret.json'));
    $client->setAccessType('offline');
    $client->setSubject('mesidor@guardianmylife.com');
    //$client->setApprovalPrompt('force');
    $client->setPrompt('consent');
    $redirect_uri = url('/google-calendar/auth-callback');
    $client->setRedirectUri($redirect_uri);
    return $client;
  }

//   function getClient() {
//     $client = new GoogleClient();
//     $client->setApplicationName('TestingApp');
//     $client->setAuthConfig(CREDENTIALS_PATH);
//     $client->setScopes(SCOPES);
//     $client->setSubject('mesidor@guardianmylife.com');
//     return $client;
//     // return 'is working?';
// }

}