<?php
namespace App\Http\Controllers;

class Google_Calendar extends Controller
{

  public function getClient()
  {
    $client = new Google_Client();
    $client->setApplicationName(config('app.name'));
    $client->setScopes(Google_Service_Directory::ADMIN_DIRECTORY_RESOURCE_CALENDAR_READONLY);
    $client->setAuthConfig(storage_path('keys/client_secret.json'));
    $client->setAccessType('offline');
    //$client->setApprovalPrompt('force');
    $client->setPrompt('consent');
    $redirect_uri = url('/google-calendar/auth-callback');
    $client->setRedirectUri($redirect_uri);
    return $client;
  }

}