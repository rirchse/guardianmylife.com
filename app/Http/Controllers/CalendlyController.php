<?php

namespace App\Http\Controllers;

use App\Services\CalendlyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CalendlyController extends Controller
{
    protected $calendlyService;

    public function __construct(CalendlyService $calendlyService)
    {
        $this->calendlyService = $calendlyService;
    }

    public function index()
    {
        $user = $this->calendlyService->getUserInfo();
        $events = $this->calendlyService->getScheduledEvents();

        return view('calendly.index', compact('user', 'events'));
    }

    public function getEvent()
    {
        $calendlyService = new CalendlyService;

        // $userUri = $calendlyService->getUserUri();
        // $eventTypeUri = $calendlyService->getEventTypes($userUri);

        $token = env('CALENDLY_API_TOKEN', '');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.calendly.com/event_types');

        $eventTypes = $response->json();
        return $eventTypes;
    }

    public function createEvent()
    {
        // $this->calendlyService = app(App\Services\CalendlyService::class);
        $calendlyService = new CalendlyService;

        $userUri = $calendlyService->getUserUri();
        $eventTypeUri = $calendlyService->getEventTypes($userUri);

        // dd($eventTypeUri);

        // $eventTypeUri = 'https://api.calendly.com/user/guardianmylife1';
        $inviteeEmail = 'rirchse@gmail.com';
        $startTime = '2025-03-01T10:00:00.000Z';  // ISO 8601 format
        $endTime = '2025-03-01T10:30:00.000Z'; 

        $scheduleResponse = $calendlyService->scheduleEvent($eventTypeUri, $inviteeEmail, $startTime, $endTime);
        dd($scheduleResponse);

    }
}
