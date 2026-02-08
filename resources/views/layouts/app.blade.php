<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pinjamin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen ml-64 pt-16">
                <!-- Top Navigation Bar -->
                @include('layouts.topbar')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-transparent">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Flash Messages -->
                <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-gradient-to-r from-white to-gray-50 border-t border-gray-200 py-4 px-6 text-center text-sm text-gray-700">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Pinjamin') }}. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>
