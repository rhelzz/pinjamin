<x-app-layout>
    <x-slot name="pageTitle">Log Aktivitas</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Log Aktivitas Sistem</h2>
                <p class="mt-1 text-sm text-gray-600">Riwayat lengkap aktivitas pengguna dan sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="flex gap-3 mb-6 overflow-x-auto">
                <div class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex-shrink-0 min-w-[180px]">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-indigo-100 rounded-lg">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-500">Total Log</p>
                            <p class="text-base font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex-shrink-0 min-w-[180px]">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-blue-100 rounded-lg">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-500">Auth</p>
                            <p class="text-base font-bold text-blue-600">{{ number_format($stats['auth']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex-shrink-0 min-w-[180px]">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-green-100 rounded-lg">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-500">CRUD</p>
                            <p class="text-base font-bold text-green-600">{{ number_format($stats['crud']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex-shrink-0 min-w-[180px]">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-amber-100 rounded-lg">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-500">Peminjaman</p>
                            <p class="text-base font-bold text-amber-600">{{ number_format($stats['peminjaman']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-3 shadow-sm flex-shrink-0 min-w-[180px]">
                    <div class="flex items-center">
                        <div class="p-1.5 bg-purple-100 rounded-lg">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-500">Pengembalian</p>
                            <p class="text-base font-bold text-purple-600">{{ number_format($stats['pengembalian']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                
                <!-- Search & Filter Header -->
                <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 p-6">
                    <form method="GET" class="space-y-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari aktivitas..." 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <select name="aksi" class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2.5">
                                    <option value="">Semua Aksi</option>
                                    <option value="auth" {{ request('aksi') === 'auth' ? 'selected' : '' }}>Auth (Login/Logout)</option>
                                    <option value="crud" {{ request('aksi') === 'crud' ? 'selected' : '' }}>CRUD Data</option>
                                    <option value="peminjaman" {{ request('aksi') === 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                                    <option value="pengembalian" {{ request('aksi') === 'pengembalian' ? 'selected' : '' }}>Pengembalian</option>
                                </select>
                            </div>
                            <div>
                                <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}" 
                                    class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2.5"
                                    placeholder="Dari tanggal">
                            </div>
                            <div>
                                <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}" 
                                    class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2.5"
                                    placeholder="Sampai tanggal">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    Filter
                                </button>
                                @if(request()->hasAny(['search', 'aksi', 'dari_tanggal', 'sampai_tanggal']))
                                    <a href="{{ route('admin.log.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Activity Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.log.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        #
                                        @if(request('sort_by') == 'id' || !request('sort_by'))
                                            @if(request('sort_direction') == 'desc')
                                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aktivitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.log.index', array_merge(request()->all(), ['sort_by' => 'timestamp', 'sort_direction' => request('sort_by') == 'timestamp' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center justify-end hover:text-indigo-600 transition-colors">
                                        Waktu
                                        @if(request('sort_by') == 'timestamp')
                                            @if(request('sort_direction') == 'asc')
                                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                        @endif
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($logs as $log)
                                @php
                                    $aktivitas = strtolower($log->aktivitas);
                                    $kategori = 'Lainnya';
                                    $kategoriColor = 'gray';
                                    
                                    if (str_contains($aktivitas, 'login') || str_contains($aktivitas, 'logout') || str_contains($aktivitas, 'register')) {
                                        $kategori = 'Auth';
                                        $kategoriColor = 'blue';
                                    } elseif (str_contains($aktivitas, 'menambah') || str_contains($aktivitas, 'mengubah') || str_contains($aktivitas, 'menghapus') || str_contains($aktivitas, 'membuat') || str_contains($aktivitas, 'edit') || str_contains($aktivitas, 'hapus') || str_contains($aktivitas, 'tambah')) {
                                        $kategori = 'CRUD';
                                        $kategoriColor = 'green';
                                    } elseif (str_contains($aktivitas, 'peminjaman') || str_contains($aktivitas, 'pinjam') || str_contains($aktivitas, 'checkout') || str_contains($aktivitas, 'approve') || str_contains($aktivitas, 'reject') || str_contains($aktivitas, 'tolak') || str_contains($aktivitas, 'setuju')) {
                                        $kategori = 'Peminjaman';
                                        $kategoriColor = 'amber';
                                    } elseif (str_contains($aktivitas, 'pengembalian') || str_contains($aktivitas, 'kembali') || str_contains($aktivitas, 'return')) {
                                        $kategori = 'Pengembalian';
                                        $kategoriColor = 'purple';
                                    }
                                @endphp
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
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $log->user->name ?? 'System' }}</p>
                                                @if($log->user)
                                                    <p class="text-xs text-gray-500 truncate">{{ $log->user->role->nama_role ?? '-' }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-700 line-clamp-2">{{ $log->aktivitas }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold 
                                            @if($kategoriColor === 'blue') bg-blue-100 text-blue-700
                                            @elseif($kategoriColor === 'green') bg-green-100 text-green-700
                                            @elseif($kategoriColor === 'amber') bg-amber-100 text-amber-700
                                            @elseif($kategoriColor === 'purple') bg-purple-100 text-purple-700
                                            @else bg-gray-100 text-gray-700
                                            @endif">
                                            {{ $kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="text-right">
                                            <time class="text-xs font-medium text-gray-500 block" title="{{ $log->timestamp->format('d F Y, H:i:s') }}">
                                                {{ $log->timestamp->diffForHumans() }}
                                            </time>
                                            <span class="text-xs text-gray-400">
                                                {{ $log->timestamp->format('d M Y, H:i') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 mb-2">Belum Ada Log Aktivitas</h3>
                                            <p class="text-sm text-gray-500 max-w-sm">
                                                @if(request()->hasAny(['search', 'aksi', 'dari_tanggal', 'sampai_tanggal']))
                                                    Tidak ada hasil untuk filter yang dipilih.
                                                @else
                                                    Log aktivitas akan muncul di sini ketika pengguna melakukan aksi di sistem.
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($logs->hasPages())
                    <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                        {{ $logs->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
