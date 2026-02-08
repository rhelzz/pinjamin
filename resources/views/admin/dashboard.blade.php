<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Dashboard Admin</h2>
                <p class="mt-1 text-sm text-gray-600">Ringkasan sistem peminjaman alat sekolah</p>
            </div>
            <div class="hidden sm:block">
                <span class="text-xs font-medium text-gray-700 bg-white border border-gray-200 px-3 py-1.5 rounded-full shadow-sm">
                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
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
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aktivitas</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($recentLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-xs font-semibold text-indigo-700 bg-indigo-100 px-2.5 py-1 rounded-full font-mono">{{ $log->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                                <span class="text-xs font-bold text-white">
                                                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'System' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-700">{{ $log->aktivitas }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <time class="text-xs font-medium text-gray-500" title="{{ $log->timestamp->format('d F Y, H:i:s') }}">
                                            {{ $log->timestamp->diffForHumans() }}
                                        </time>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-sm font-semibold text-gray-900">Belum ada aktivitas</p>
                                            <p class="text-xs text-gray-500 mt-1">Aktivitas pengguna akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($recentLogs->isNotEmpty())
                    <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                        <a href="{{ route('admin.log.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                            Lihat Semua Log
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
