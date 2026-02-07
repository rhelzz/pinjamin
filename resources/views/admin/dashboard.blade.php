<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Dashboard Admin</h2>
                <p class="mt-1 text-sm text-gray-600">Ringkasan sistem peminjaman alat sekolah</p>
            </div>
            <div class="hidden sm:block">
                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full">
                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Title Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Statistik Sistem</h3>
                <p class="mt-1 text-sm text-gray-600">Data ringkasan dari seluruh sistem</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
                
                <!-- Total Users Card -->
                <div class="group relative bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full -mr-16 -mt-16 opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Total Users</p>
                                <p class="text-3xl font-extrabold text-gray-900 mb-1">{{ $totalUsers }}</p>
                                <p class="text-xs text-gray-500">Pengguna terdaftar</p>
                            </div>
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-lg shadow-md">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Alat Card -->
                <div class="group relative bg-gradient-to-br from-green-50 to-white border border-green-100 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-100 rounded-full -mr-16 -mt-16 opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-1">Total Alat</p>
                                <p class="text-3xl font-extrabold text-gray-900 mb-1">{{ $totalAlat }}</p>
                                <p class="text-xs text-gray-500">Item tersedia</p>
                            </div>
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-lg shadow-md">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori Card -->
                <div class="group relative bg-gradient-to-br from-amber-50 to-white border border-amber-100 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100 rounded-full -mr-16 -mt-16 opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-1">Kategori</p>
                                <p class="text-3xl font-extrabold text-gray-900 mb-1">{{ $totalKategori }}</p>
                                <p class="text-xs text-gray-500">Jenis alat</p>
                            </div>
                            <div class="flex-shrink-0 p-3 bg-amber-500 rounded-lg shadow-md">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman Card -->
                <div class="group relative bg-gradient-to-br from-indigo-50 to-white border border-indigo-100 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-100 rounded-full -mr-16 -mt-16 opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-1">Peminjaman</p>
                                <p class="text-3xl font-extrabold text-gray-900 mb-1">{{ $totalPeminjaman }}</p>
                                <p class="text-xs text-gray-500">Total transaksi</p>
                            </div>
                            <div class="flex-shrink-0 p-3 bg-indigo-500 rounded-lg shadow-md">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent Activity Log Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                <p class="mt-1 text-sm text-gray-600">Log aktivitas sistem yang terbaru</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8">
                    
                    <!-- Activity Timeline -->
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @forelse($recentLogs as $index => $log)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute top-10 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        @endif
                                        
                                        <div class="relative flex items-start space-x-4 group">
                                            <!-- Avatar -->
                                            <div class="relative flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center ring-4 ring-white shadow-md">
                                                    <span class="text-sm font-bold text-white">
                                                        {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                                    </span>
                                                </div>
                                                <span class="absolute -bottom-0.5 -right-1 bg-green-400 rounded-full p-1 ring-2 ring-white">
                                                    <svg class="h-2.5 w-2.5 text-white" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3"/>
                                                    </svg>
                                                </span>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="min-w-0 flex-1">
                                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 group-hover:bg-gray-100 group-hover:border-gray-300 transition-colors duration-200">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $log->user->name ?? 'System' }}
                                                        </p>
                                                        <time class="text-xs font-medium text-gray-500 bg-white px-2 py-1 rounded-full border border-gray-200">
                                                            {{ $log->timestamp->diffForHumans() }}
                                                        </time>
                                                    </div>
                                                    <p class="text-sm text-gray-700 leading-relaxed">
                                                        {{ $log->aktivitas }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li>
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <h3 class="mt-4 text-sm font-semibold text-gray-900">Belum ada aktivitas</h3>
                                        <p class="mt-2 text-sm text-gray-500">Aktivitas pengguna akan muncul di sini</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- View All Link -->
                    @if($recentLogs->isNotEmpty())
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.log.index') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <span>Lihat Semua Log</span>
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
