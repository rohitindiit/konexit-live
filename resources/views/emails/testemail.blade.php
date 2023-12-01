<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
	@component('mail::message')
    <h1>{{ $body['title'] }}</h1>
    <p>{{ $body['body'] }}</p>
    @endcomponent
   
    <p>Thank you</p>
</body>
</html>