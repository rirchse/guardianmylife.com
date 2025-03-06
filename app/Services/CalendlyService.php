<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CalendlyService
{
    protected $apiUrl = 'https://api.calendly.com';

    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.calendly.api_token');
        $this->baseUrl = config('services.calendly.base_url');
    }

    public function getUserUri()
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type'  => 'application/json',
        ])->get("{$this->baseUrl}/users/me");

        if ($response->successful()) {
            return $response->json()['resource']['uri'];
        }

        return null;
    }

    public function getUserInfo()
    {
        $response = Http::withToken(config('services.calendly.api_token'))
            ->get("{$this->apiUrl}/users/me");

        return $response->json();
    }

    public function getEventTypes($userUri)
    {
        $response = Http::withToken(config('services.calendly.api_token'))
            ->get("{$this->apiUrl}/event_types", ['user' => $userUri]);

        return $response->json();
    }

    public function getScheduledEvents()
    {
        $response = Http::withToken(config('services.calendly.api_token'))
            ->get("{$this->apiUrl}/scheduled_events");

        return $response->json();
    }

    public function scheduleEvent($eventTypeUri, $inviteeEmail, $startTime, $endTime)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type'  => 'application/json',
        ])->post("{$this->baseUrl}/scheduled_events", [
            'event_type' => $eventTypeUri,
            'start_time' => $startTime,
            'end_time'   => $endTime,
            'invitees'   => [
                [
                    'email' => $inviteeEmail
                ]
            ]
        ]);

        return $response->json();
    }

}
