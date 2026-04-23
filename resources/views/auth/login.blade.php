<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Login') }} - {{ config('app.name', 'Pinjamin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .pastel-gradient {
            background: linear-gradient(135deg, #f3f4f6 0%, #e0e7ff 100%);
        }
        .soft-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .floating-image {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .input-pastel {
            @apply border-indigo-100 bg-indigo-50/30 focus:bg-white focus:ring-indigo-200 focus:border-indigo-300 transition-all duration-300;
        }
        .btn-pastel {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
            @apply shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-0.5 transition-all duration-300;
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#f8fafc]">
    <div class="min-h-screen flex items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-6xl bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/50 flex overflow-hidden min-h-[700px]">
            <!-- Left Side - Visual -->
            <div class="hidden lg:flex lg:w-1/2 bg-[#eef2ff] relative items-center justify-center overflow-hidden">
                <!-- Background Decorative Circles -->
                <div class="absolute -top-20 -left-20 w-64 h-64 bg-indigo-200/50 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-pink-200/50 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center p-12">
                    <img src="{{ asset('3d-assets-png/Book Reading.png') }}" alt="Reading Book" class="w-full max-w-md mx-auto floating-image mb-8 drop-shadow-2xl">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-4">Mulai Petualanganmu</h1>
                    <p class="text-indigo-600/80 text-lg">Akses ribuan referensi produktif dengan satu klik mudah.</p>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16">
                <div class="w-full max-w-sm">
                    <!-- Logo & Header -->
                    <div class="mb-10 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 mb-6 lg:mb-8">
                            <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600">Pinjamin</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
                        <p class="text-gray-500">Silakan masuk ke akun Anda untuk melanjutkan.</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm text-emerald-700 font-medium">{{ session('status') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-gray-700 ml-1">Email Address</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </span>
                                <input 
                                    id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all outline-none text-gray-700"
                                    placeholder="Enter your email"
                                >
                            </div>
                            @error('email')
                                <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-semibold text-gray-700 ml-1">Password</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input 
                                    id="password" type="password" name="password" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all outline-none text-gray-700"
                                    placeholder="••••••••"
                                >
                            </div>
                            @error('password')
                                <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between px-1">
                            <label class="flex items-center group cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-200 rounded-md focus:ring-indigo-500/20">
                                <span class="ml-2 text-sm text-gray-500 group-hover:text-indigo-600 transition-colors">Ingat saya</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lupa sandi?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn-pastel w-full py-4 text-white font-bold rounded-2xl transform active:scale-[0.98]">
                            Masuk Sekarang
                        </button>
                    </form>

                    <div class="mt-10 text-center">
                        <p class="text-gray-500">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4 ml-1">Daftar Gratis</a>
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="mt-12 text-center">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                            &copy; {{ date('Y') }} Pinjamin &bull; Perpus Digital Modern
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
