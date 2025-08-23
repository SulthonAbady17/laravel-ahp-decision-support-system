<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="csrf-token{{ csrf_token() }}">
        <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}
    </head>

    <body class="bg-surface-alt text-on-surface dark:bg-surface-dark dark:text-on-surface-dark">
        {{-- Pembungkus utama untuk layout vertikal --}}
        <div class="flex min-h-screen flex-col">

            {{-- Header akan selalu di atas --}}
            @include('partials.header')

            {{-- Konten Utama --}}
            <main class="flex-grow">
                {{-- Slot ini akan diisi oleh halaman spesifik --}}
                @yield('content')
            </main>

            {{-- Footer (opsional, akan menempel di bawah) --}}
            @include('partials.footer')

        </div>

        {{-- Wadah untuk menampung script yang di-push dari halaman lain --}}
        @stack('scripts')
    </body>

</html>
