<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Register') }} - {{ config('app.name', 'Pinjamin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .floating-image {
            animation: floating 3.5s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .btn-pastel-pink {
            background: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
            @apply shadow-lg shadow-pink-200 hover:shadow-pink-300 hover:-translate-y-0.5 transition-all duration-300;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-tr from-rose-100 via-orange-50 to-amber-100 min-h-screen relative overflow-x-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[20%] right-[5%] w-[35%] h-[35%] bg-pink-200/40 rounded-full blur-[100px] animate-bounce-slow"></div>
        <div class="absolute -bottom-[5%] -left-[5%] w-[30%] h-[30%] bg-amber-200/40 rounded-full blur-[80px]"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 lg:p-8 relative z-10">
        <div class="w-full max-w-6xl bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-rose-200/50 flex overflow-hidden min-h-[800px] border border-white/40">
            <!-- Left Side - Visual -->
            <div class="hidden lg:flex lg:w-1/2 bg-[#fff1f2] relative items-center justify-center overflow-hidden">
                <!-- Background Decorative Circles -->
                <div class="absolute -top-20 -left-20 w-64 h-64 bg-pink-200/50 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/50 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center p-12">
                    <img src="{{ asset('3d-assets-png/Bookshelf 3.png') }}" alt="Bookshelf" class="w-full max-w-md mx-auto floating-image mb-8 drop-shadow-2xl">
                    <h1 class="text-4xl font-bold text-pink-900 mb-4">Gabung Bersama Kami</h1>
                    <p class="text-pink-600/80 text-lg">Mulai perjalanan literasimu dengan akses tak terbatas ke koleksi terbaik.</p>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 lg:p-12 overflow-y-auto">
                <div class="w-full max-w-sm my-auto">
                    <!-- Header -->
                    <div class="mb-8 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 mb-6 lg:mb-6">
                            <div class="w-10 h-10 bg-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-pink-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-rose-600">Pinjamin</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun</h2>
                        <p class="text-gray-500">Daftar sekarang untuk mulai meminjam buku produktif.</p>
                    </div>

                    <!-- Info Box -->
                    <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-100 flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-amber-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-[13px] text-amber-700 leading-relaxed font-medium">
                            Akun Anda memerlukan persetujuan admin sebelum dapat digunakan.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div class="space-y-1.5">
                            <label for="name" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Nama Lengkap</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-4 py-3 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 focus:bg-white transition-all outline-none text-gray-700"
                                placeholder="Masukkan nama lengkap">
                            @error('name') <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <!-- Username -->
                        <div class="space-y-1.5">
                            <label for="username" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Username</label>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-3 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 focus:bg-white transition-all outline-none text-gray-700"
                                placeholder="Pilih username unik">
                            @error('username') <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 focus:bg-white transition-all outline-none text-gray-700"
                                placeholder="nama@email.com">
                            @error('email') <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{ show: false }">
                            <div class="space-y-1.5 relative">
                                <label for="password" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Sandi</label>
                                <div class="relative">
                                    <input id="password" :type="show ? 'text' : 'password'" name="password" required
                                        class="w-full pl-4 pr-10 py-3 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 focus:bg-white transition-all outline-none text-gray-700"
                                        placeholder="••••••••">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-pink-500 transition-colors focus:outline-none">
                                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.05 0 014.459-5.591M10.148 4.653A11.959 11.959 0 0112 4.5c4.478 0 8.268 2.943 9.542 7a10.025 10.05 0 01-4.132 5.411m0 0L21 21m-2.105-2.105L17.53 17.53m-1.493-1.493L3 3m6.758 11.758a3 3 0 114.243-4.243m-4.242 4.242L9.88 9.88"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label for="password_confirmation" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Konfirmasi</label>
                                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required
                                    class="w-full px-4 py-3 bg-gray-50 border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 focus:bg-white transition-all outline-none text-gray-700"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        @error('password') <p class="text-xs text-rose-500 ml-1 mt-1 font-medium">{{ $message }}</p> @enderror

                        <button type="submit" class="btn-pastel-pink w-full py-4 text-white font-bold rounded-2xl transform active:scale-[0.98] mt-4">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-gray-500">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-pink-600 font-bold hover:underline underline-offset-4 ml-1">Masuk</a>
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="mt-8 text-center">
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
