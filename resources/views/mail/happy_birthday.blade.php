<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>FFL Falcon</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<body style="background: #ddd;">
	<div class="wrapper" style="max-width:700px; margin:auto; font-family: sans-serif;">

		<!-- email header -->
		{{-- <div section="header" style="clear:both; padding:15px; background:#FFEDB6 url() no-repeat left bottom;">
			<div name="banner" style="width:100%;">
				<div name="banner-text" style="width:100%; margin-top: 32px; text-align:center">
					<p style="font-size: 28px;color: #191616;">Happy Birthday!</p>
				</div>
			</div>
		</div> --}}

		<!-- section: email text body -->
		<div section="body" style="background:#fff; margin-bottom:5px">
			<div style="overflow: hidden;">
				<img src="{{ $message->embed('img/happy_birthday.jpg') }}" alt="" style="width:100%">
				<div style="padding:25px; text-align:left; font-family:sans-serif;color: #525252;">
					{{-- <h3 style="text-align: center">I pray and wish that<br> life brings beautiful <br>surprise for every candle<br> on your birthday cake.<br> Have an outstanding birthday!</h3> --}}
					<img src="{{ $message->embed('img/happy_birthday_text.jpg') }}" alt="" style="width:100%">

				</div>
			</div>
		</div>
		<!-- email footer -->

		<div style="padding-bottom: 30px; background: #fff; padding: 25px; display: block;">
			<img src="{{ $message->embed('img/logo.png') }}" alt="logo" style="float: left; display: flex; width: 180px; padding: 20px;">
			<p style="font-size: 21px; width:100%">
			Mesidor Azor<br>
			Founder & CEO<br>
			<a href="http://fflfalcon.com" target="_blank">FFL Falcon</a><br>
			Address:<br>
			Phone: +1 (646) 725-6292<br>
			<a href="http://fflfalcon.com">www.fflfalcon.com</a>
		</p>
		</div>

		{{-- <div style="background: #276df0; color: #fff;text-align: center;">
			<img src="" alt="" style="width: 230px;padding: 22px;">
		</div> --}}

		<div class="footer" style="color: #fff; clear:both; background: #000; width: 100%; display:table;">
			{{-- <div section="footer-left" style="display:table-cell; width: 60%; position:relative; padding:25px; line-height:25px">
				<a href="#" style="float: left; text-decoration: none; color:#fff;background: #000">FAQ</a> 
				<br>
				<a href="#" style="color:#fff; text-decoration: none;">Forgot password?</a><br>
				<a href="#" style="color:#fff; text-decoration: none;">Privacy</a> <br>
				<a href="#" style="color:#fff; text-decoration: none;">Terms</a>
			</div>
			<div section="footer-right" style="display:table-cell; width:100%;max-width: 40%; padding:25px">
				<strong style="font-size:16px">FFLFalcon</strong>
			</div> --}}
		</div>

	</div>
</body>
</html>