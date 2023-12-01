<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
	@component('mail::message')
    <h1>Hello {{ $body['name'] }}</h1>
    <p>{{ $body['body'] }}</p>
    <x-mail::button :url="$body['url']">
	 {{ $body['buttoname'] }}
	</x-mail::button>

    @endcomponent
    <p>Thank you</p>
</body>
</html>