<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight">Dashboard Peminjam</h2>
                <p class="mt-0.5 text-sm text-gray-500">Kelola peminjaman alat sekolah Anda</p>
            </div>
            <div class="hidden sm:flex items-center space-x-2">
                <span class="text-xs font-medium text-gray-600 bg-white/80 backdrop-blur-sm border border-gray-200/50 px-3 py-1.5 rounded-full shadow-sm">
                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Hero Section -->
            <div class="mb-6 gradient-purple wave-pattern rounded-2xl shadow-xl p-6 text-white">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-100 mb-1">Selamat Datang!</p>
                        <h3 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-purple-100 text-sm">Mulai pinjam alat dengan mengunjungi katalog alat kami</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white text-sm font-medium rounded-xl transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                            </svg>
                            Lihat Katalog
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                
                <!-- Peminjaman Aktif -->
                <div class="stat-card rounded-xl p-5 border border-gray-100/50 shadow-lg group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-blue-100 rounded-full -mr-14 -mt-14 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-blue-200 rounded-full -ml-12 -mb-12 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 gradient-blue rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Sedang Aktif</p>
                                    <p class="text-3xl font-bold text-blue-600">{{ $peminjamanAktif }}</p>
                                    <p class="text-sm text-gray-400">Peminjaman</p>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group/link">
                            <span>Lihat riwayat peminjaman</span>
                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="stat-card rounded-xl p-5 border border-gray-100/50 shadow-lg group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-green-100 rounded-full -mr-14 -mt-14 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-green-200 rounded-full -ml-12 -mb-12 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 gradient-green rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total</p>
                                    <p class="text-3xl font-bold text-green-600">{{ $totalPeminjaman }}</p>
                                    <p class="text-sm text-gray-400">Seluruh Peminjaman</p>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-green-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group/link">
                            <span>Lihat semua transaksi</span>
                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <!-- Katalog Alat -->
                <div class="glass-card rounded-2xl p-5 border border-gray-100/50 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-indigo rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">Katalog Alat</h4>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Jelajahi alat yang tersedia untuk dipinjam</p>
                    <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center w-full justify-center px-4 py-2 text-xs font-medium text-white gradient-indigo rounded-lg hover:opacity-90 transition shadow-md">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Jelajahi Katalog
                    </a>
                </div>

                <!-- Keranjang -->
                <div class="glass-card rounded-2xl p-5 border border-gray-100/50 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-amber rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">Keranjang</h4>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Cek alat yang sudah Anda pilih</p>
                    <a href="{{ route('peminjam.cart.index') }}" class="inline-flex items-center w-full justify-center px-4 py-2 text-xs font-medium text-white gradient-amber rounded-lg hover:opacity-90 transition shadow-md">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Buka Keranjang
                    </a>
                </div>

                <!-- Booking -->
                <div class="glass-card rounded-2xl p-5 border border-gray-100/50 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-cyan rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">Booking</h4>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Jadwalkan peminjaman di kemudian hari</p>
                    <a href="{{ route('peminjam.booking.index') }}" class="inline-flex items-center w-full justify-center px-4 py-2 text-xs font-medium text-white gradient-cyan rounded-lg hover:opacity-90 transition shadow-md">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Lihat Booking
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
