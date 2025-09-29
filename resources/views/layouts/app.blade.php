<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Letselschade-Hotline - Direct hulp na een ongeval. Professionele begeleiding bij letselschade claims.">
    
    <title>@yield('title', 'Letselschade-Hotline - Direct hulp na een ongeval')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10859171119"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-10859171119'); </script> 

    @if (session('success_msg'))
        <!-- Event snippet for Leadformulier indienen conversion page --> 
        <script> 
            gtag('event', 'conversion', { 'send_to': 'AW-11561362909/K7m6CLzNi4caEN3L8Ygr', 'value': 1.0, 'currency': 'EUR' }); 
        </script> 
    @endif

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.partials.header')

    @yield('content')

    @include('layouts.partials.footer')
</body>
</html> 