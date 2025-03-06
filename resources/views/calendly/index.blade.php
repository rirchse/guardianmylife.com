@extends('layouts.homepage')

@section('content')
    <div class="container">
        <h2>Calendly User Info</h2>
        <pre>{{ json_encode($user, JSON_PRETTY_PRINT) }}</pre>

        <h2>Scheduled Events</h2>
        <pre>{{ json_encode($events, JSON_PRETTY_PRINT) }}</pre>
    </div>

    <div>
      <iframe src="https://calendly.com/guardianmylife1" width="100%" height="600" frameborder="0"></iframe>

    </div>
@endsection
