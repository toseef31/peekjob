<!DOCTYPE html>
<html>
<head>
	<title>broadcoast</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
	<h1 id="h"></h1>
	<input type="text" id="message" name="">
	<a onclick="senmessage()">message</a>
<div id="app"></div>
<script src="{{ asset('js/app.js')}}"></script>
<script type="text/javascript">
	function senmessage(){
		var message = $('#message').val();
		$.ajax({
			url:"{{ url('/event') }}",
			type:'get',
			data:{message:message}
		});
	}
</script>
</body>
</html>