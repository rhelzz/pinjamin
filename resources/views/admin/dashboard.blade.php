<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
                <p class="mt-0.5 text-sm text-gray-500">Ringkasan sistem peminjaman alat</p>
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
            
            <!-- Hero Stats Card -->
            <div class="mb-6 gradient-blue wave-pattern rounded-2xl shadow-xl p-6 text-white">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-blue-100 mb-1">Statistik Sistem</p>
                    <h3 class="text-3xl font-bold mb-1">Selamat Datang!</h3>
                    <p class="text-blue-100 text-sm">Platform manajemen peminjaman alat sekolah</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                
                <!-- Total Users -->
                <div class="stat-card rounded-xl p-4 border border-gray-100/50 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-blue-200 rounded-full -ml-8 -mb-8 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 gradient-blue rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Users</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                        <p class="text-xs text-gray-500 mt-1">Pengguna terdaftar</p>
                    </div>
                </div>

                <!-- Total Alat -->
                <div class="stat-card rounded-xl p-4 border border-gray-100/50 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-200 rounded-full -ml-8 -mb-8 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 gradient-green rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Alat</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalAlat }}</p>
                        <p class="text-xs text-gray-500 mt-1">Item tersedia</p>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="stat-card rounded-xl p-4 border border-gray-100/50 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-amber-100 rounded-full -mr-10 -mt-10 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-amber-200 rounded-full -ml-8 -mb-8 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 gradient-amber rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Kategori</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalKategori }}</p>
                        <p class="text-xs text-gray-500 mt-1">Jenis alat</p>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="stat-card rounded-xl p-4 border border-gray-100/50 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-purple-100 rounded-full -mr-10 -mt-10 opacity-40"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-200 rounded-full -ml-8 -mb-8 opacity-30"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 gradient-purple rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Transaksi</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPeminjaman }}</p>
                        <p class="text-xs text-gray-500 mt-1">Total peminjaman</p>
                    </div>
                </div>

            </div>

            <!-- Activity Log Section -->
            <div class="glass-card rounded-2xl shadow-lg border border-gray-100/50 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100/50 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 gradient-indigo rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800">Aktivitas Terbaru</h3>
                            <p class="text-xs text-gray-500">Log aktivitas sistem</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.log.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 flex items-center space-x-1">
                        <span>Lihat Semua</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto scrollbar-modern">
                    <table class="w-full">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aktivitas</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100/50">
                            @forelse($recentLogs as $log)
                                <tr class="hover:bg-indigo-50/30 transition-colors">
                                    <td class="px-5 py-3">
                                        <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md font-mono">{{ $log->id }}</span>
                                    </td>
                                    <td class="px-5 py-3">
                                        <div class="flex items-center space-x-2">
                                            <div class="h-7 w-7 rounded-lg gradient-purple flex items-center justify-center flex-shrink-0">
                                                <span class="text-xs font-bold text-white">
                                                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">{{ $log->user->name ?? 'System' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3">
                                        <span class="text-sm text-gray-600">{{ $log->aktivitas }}</span>
                                    </td>
                                    <td class="px-5 py-3 text-right">
                                        <time class="text-xs font-medium text-gray-400" title="{{ $log->timestamp->format('d F Y, H:i:s') }}">
                                            {{ $log->timestamp->diffForHumans() }}
                                        </time>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-10 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center mb-3">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-medium text-gray-600">Belum ada aktivitas</p>
                                            <p class="text-xs text-gray-400 mt-0.5">Aktivitas akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
