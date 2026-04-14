<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Merco') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased bg-[#F6F7F9]">
        {{-- IMPORTANTE: aquí NO hay max-w-md, ni tarjeta fija --}}
        {{ $slot }}
    </body>
</html>