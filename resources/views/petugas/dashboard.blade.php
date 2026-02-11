<x-app-layout>
    <x-slot name="pageTitle">Dashboard Petugas</x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight">Dashboard Petugas</h2>
                <p class="mt-0.5 text-sm text-gray-500">Kelola peminjaman dan pengembalian alat</p>
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
            
            <!-- Hero Section -->
            <div class="mb-6 gradient-cyan wave-pattern rounded-2xl shadow-xl p-6 text-white">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-cyan-100 mb-1">Selamat Bekerja!</p>
                    <h3 class="text-2xl font-bold mb-1">Panel Petugas</h3>
                    <p class="text-cyan-100 text-sm">Kelola persetujuan dan pengembalian peminjaman alat</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                
                <!-- Menunggu Persetujuan -->
                <div class="stat-card rounded-xl p-5 border border-gray-100/50 shadow-lg group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-100 rounded-full -mr-12 -mt-12 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-amber-200 rounded-full -ml-10 -mb-10 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-amber rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Menunggu</p>
                                    <p class="text-2xl font-bold text-amber-600">{{ $pendingCount }}</p>
                                    <p class="text-xs text-gray-400">Persetujuan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('petugas.approval.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group/link">
                            <span>Proses sekarang</span>
                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Sedang Dipinjam -->
                <div class="stat-card rounded-xl p-5 border border-gray-100/50 shadow-lg group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-full -mr-12 -mt-12 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-200 rounded-full -ml-10 -mb-10 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-blue rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Sedang</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $dipinjamCount }}</p>
                                    <p class="text-xs text-gray-400">Dipinjam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('petugas.pengembalian.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group/link">
                            <span>Proses pengembalian</span>
                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="stat-card rounded-xl p-5 border border-gray-100/50 shadow-lg group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-100 rounded-full -mr-12 -mt-12 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-green-200 rounded-full -ml-10 -mb-10 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-green rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $selesaiCount }}</p>
                                    <p class="text-xs text-gray-400">Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('petugas.laporan.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group/link">
                            <span>Lihat laporan</span>
                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Action Card: Approval -->
                <div class="glass-card rounded-2xl p-5 border border-gray-100/50 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 gradient-purple rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-800">Persetujuan Peminjaman</h4>
                            <p class="text-xs text-gray-500 mt-1">Kelola permintaan peminjaman dari pengguna</p>
                            <a href="{{ route('petugas.approval.index') }}" class="inline-flex items-center mt-3 px-4 py-2 text-xs font-medium text-white gradient-indigo rounded-lg hover:opacity-90 transition shadow-md">
                                <span>Buka Persetujuan</span>
                                <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Action Card: History -->
                <div class="glass-card rounded-2xl p-5 border border-gray-100/50 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 gradient-cyan rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-800">Riwayat Peminjaman</h4>
                            <p class="text-xs text-gray-500 mt-1">Lihat seluruh history peminjaman alat</p>
                            <a href="{{ route('petugas.history.index') }}" class="inline-flex items-center mt-3 px-4 py-2 text-xs font-medium text-white gradient-cyan rounded-lg hover:opacity-90 transition shadow-md">
                                <span>Lihat Riwayat</span>
                                <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
