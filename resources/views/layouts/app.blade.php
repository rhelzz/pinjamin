<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $pageTitle ?? config('app.name', 'Pinjamin') }} - {{ config('app.name', 'Pinjamin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- Toast Notification Component --}}
        <x-toast-notification />
        
        <div class="min-h-screen dashboard-bg flex">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen ml-64 pt-16">
                <!-- Top Navigation Bar -->
                @include('layouts.topbar', ['pageTitle' => $pageTitle ?? null])

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-transparent">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="glass-card border-t border-gray-200/50 py-4 px-6 text-center text-sm text-gray-600">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Pinjamin') }}. All rights reserved.
                </footer>
            </div>
        </div>
        
        {{-- Auto-trigger toast for session flash messages --}}
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toast.success("{{ session('success') }}");
                });
            </script>
        @endif
        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toast.error("{{ session('error') }}");
                });
            </script>
        @endif
        @if(session('warning'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toast.warning("{{ session('warning') }}");
                });
            </script>
        @endif
        @if(session('info'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toast.info("{{ session('info') }}");
                });
            </script>
        @endif
        
        @stack('scripts')
    </body>
</html>
