<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>FFL Falcon</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<body style="background: #ddd;padding:15px">
	<div class="wrapper" style="max-width:700px; margin:15px auto; font-family: sans-serif;">

		<!-- section: email text body -->
		<div section="body" style="background:#fff; margin-bottom:5px">
			<div style="overflow: hidden;">
				<img src="{{ $message->embed($banner) }}" alt="" style="width:100%">
				<div style="padding:25px; text-align:left; font-family:sans-serif;color: #525252;">
					<p style="font-weight:bold">{!!$email_title!!}</p>
					<p style="text-align: center;font-size:18px">{!!$email_body!!}</p>
        </div>
			</div>
		</div>

		<!-- email footer -->
		@if(!empty($agent))
		<div style="padding-bottom: 30px; background: #fff; padding: 25px; display: block;">
			<img src="{{ $message->embed($logo) }}" alt="logo" style="float: left; display: flex; width: 130px; padding: 20px;">
			<p style="font-size: 21px; width:100%">
			{!! $agent->name !!}<br>
			Agent<br>
			<a href="{{config('app.url')}}" target="_blank">{{config('app.name')}}</a><br>
			Address:{!! $agent->address !!}<br>
			Phone: {!! $agent->contact !!}<br>
			<a href="{{config('app.url')}}">{{config('app.url')}}</a>
			</p>
		</div>
		@else
		<div style="padding-bottom: 30px; background: #fff; padding: 25px; display: block;">
			<img src="{{ $message->embed($logo) }}" alt="logo" style="float: left; display: flex; width: 180px; padding: 20px;">
			<p style="font-size: 21px; width:100%">
			<a href="{{config('app.url')}}" target="_blank">{{config('app.name')}}</a><br>
			Phone: (347) 336-1929<br>
			<a href="{{config('app.url')}}">{{config('app.url')}}</a>
			</p>
		</div>
		@endif
	</div>
</body>
</html>