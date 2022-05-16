<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
          rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

    <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
            <?php
                $user = \Illuminate\Support\Facades\Auth::user();
            ?>
        @if($user)
            @if('Admin'===$user->role or 'User'===$user->role)
                <main>
                    {{ $slot }}
                </main>
            @endif
        @else
            <main>
                {{ $slot }}
            </main>
        @endif
</div>
</body>
<footer>
    <div style="text-align: center; background-color: gainsboro">
        <div>
            <div>
                <span>г. Абакан</span><br>
                <span class="font-s2 text-secondary">© «Adverts», 2022</span>
            </div>
            <div>
                <a href="tel:+7 (391) 27-37-015" class="text-black">
                    <i class="icon i-phone font-3 text-brand"></i> +7 (923) 383-00-93
                </a>
                <a href="https://vk.com/radomir_mir" class="text-black"><i class="icon i-vk-social-network-logo font-3 in-circle">Артур Лебедев</i></a>
            </div>
        </div>
    </div>
</footer>
</html>
