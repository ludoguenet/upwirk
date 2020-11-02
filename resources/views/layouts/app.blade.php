<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upwork</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
        html {
            scroll-behavior: smooth;
        }
        
        [x-cloak] {
            display: none !important;
        }
        </style>
        @livewireStyles
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.2/dist/alpine.min.js" defer></script>
    </head>
    <body>
      <div class="container mx-auto px-4">
      @include('partials.navbar')
      <livewire:alert />
      @yield('content')
      </div>
    @livewireScripts
    </body>
</html>
