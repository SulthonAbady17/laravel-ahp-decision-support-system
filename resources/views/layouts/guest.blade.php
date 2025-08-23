<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="{{ csrf_token() }}" name="csrf-token">

        <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="text-on-surface font-sans antialiased">
        {{-- Latar belakang utama --}}
        <div
            class="bg-surface-alt dark:bg-surface-dark flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
            <div>
                <a href="/">
                    <h1 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold">
                        SPK <span class="text-primary dark:text-primary-dark">PSM</span>
                    </h1>
                </a>
            </div>

            {{-- Latar belakang Konten/Card --}}
            <div
                class="bg-surface dark:bg-surface-dark-alt rounded-radius border-outline dark:border-outline-dark mt-6 w-full overflow-hidden border px-6 py-8 shadow-md sm:max-w-md">
                @yield('content')
            </div>
        </div>
    </body>

</html>
