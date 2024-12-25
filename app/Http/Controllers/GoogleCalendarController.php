<?php

namespace App\Http\Controllers;
use Spatie\GoogleCalendar\Event;
// use App\Http\Controllers\Google_Calendar;
use Spatie\GoogleCalendar\GoogleCalendar;
use Spatie\GoogleCalendar\GoogleCalendarFactory;
use Carbon\Carbon;

use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Google_Client;

// use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{

  public function connect()
  {
    // $LOCATION_OF_JSON_KEY = storage_path('keys/client_secret.json');

    $google_client = new Google_Client();
    $google_client->setAuthConfig(storage_path('keys/client_secret.json'));
    $google_client->setAccessType('offline');
    $google_client->setSubject('mesidor@guardianmylife.com');
    $google_client->setApplicationName("Web client 2");
    $google_client->setScopes([\Google_Service_Calendar::CALENDAR, \Google_Service_Calendar::CALENDAR_EVENTS]);

    return $google_client;
  }



  /** ---------------------------------- */
  public function index()
  {
    $events = Event::get(null, null, [], ENV('GOOGLE_CALENDAR_ID'));
    // dd($events);
    return $events;
  }

  public function create(array $data)
  {
    $event = new Event;
    $event->name = $data['title'];
    $event->description = $data['details'];
    $event->location = $data['location'];
    // $event->addMeetLink();
    // $event->addAttendee(['email' => 'rirstt@gmail.com']);
    $event->startDateTime = Carbon::parse($data['date_time']);
    // $event->startDateTime = Carbon::now();
    $event->endDateTime = Carbon::parse($data['date_time'])->addHour();

    $optParams = [
      'sendNotifications' => true
    ];

    $event->save('insertEvent', $optParams);
    // $event->save();
    // dd($event);
    $lastEvent = $this->getLastEvent($event->startDateTime);
    return $lastEvent;
  }

  public function store()
  {
    $client = GoogleCalendar::getClient();
    $authCode = request('code');
    $credentialsPath = storage_path('keys/client_secret_generated.json');

    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

    // Store the credentials to disk.
    if (!file_exists(dirname($credentialsPath))) 
    {
      mkdir(dirname($credentialsPath), 0700, true);
    }

    file_put_contents($credentialsPath, json_encode($accessToken));

    return redirect('/google-calendar')->with('message', 'Credentials saved');

  }

  public function getEvent($event_id)
  {
    $event = Event::find($event_id, env('GOOGLE_CALENDAR_ID'));
    // dd($event);
    return $event;
  }

  public function getResources()
  {
    // Get the authorized client object and fetch the resources.
    $client = GoogleCalendar::oauth();
    return GoogleCalendar::getResources($client);
  }

  /** get last event */
  public function getLastEvent($datetime)
  {
    $events = Event::get(Carbon::parse($datetime), null, [], env('GOOGLE_CALENDAR_ID'));
    // dd($events[0]->googleEvent);
    $event = $events[0]->googleEvent;
    $lastEvent = [
      'event_id' => $event->id,
      'htmlLink' => $event->htmlLink,
      'hangoutLink' => $event->hangoutLink,
    ];
    return $lastEvent;
  }
}