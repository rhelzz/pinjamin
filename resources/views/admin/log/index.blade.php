<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Log Aktivitas Sistem</h2>
                <p class="mt-1 text-sm text-gray-600">Riwayat lengkap aktivitas pengguna dan sistem</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ $logs->total() }} Aktivitas
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Main Content Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                
                <!-- Search & Filter Header -->
                <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 p-6">
                    <form method="GET" class="space-y-3">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari aktivitas, nama user, atau aksi..." 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.log.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                        </div>
                        
                        <!-- Sorting Options -->
                        <div class="flex items-center gap-2 text-sm">
                            <span class="text-gray-600 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                </svg>
                                Urutkan:
                            </span>
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <a href="{{ route('admin.log.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" 
                               class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ request('sort_by', 'id') == 'id' ? 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                ID
                                @if(request('sort_by', 'id') == 'id')
                                    @if(request('sort_direction', 'asc') == 'asc')
                                        <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                    @else
                                        <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                    @endif
                                @endif
                            </a>
                            <a href="{{ route('admin.log.index', array_merge(request()->all(), ['sort_by' => 'timestamp', 'sort_direction' => request('sort_by') == 'timestamp' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" 
                               class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ request('sort_by') == 'timestamp' ? 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                Waktu
                                @if(request('sort_by') == 'timestamp')
                                    @if(request('sort_direction') == 'asc')
                                        <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                    @else
                                        <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                    @endif
                                @endif
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Activity Timeline -->
                <div class="p-6 md:p-8">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @forelse($logs as $log)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute top-12 left-6 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        @endif
                                        
                                        <div class="relative flex items-start space-x-4 group">
                                            <!-- Number Badge -->
                                            <div class="flex-shrink-0 w-12 flex items-center justify-center">
                                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 ring-4 ring-white shadow-md group-hover:from-indigo-100 group-hover:to-indigo-200 transition-all duration-200">
                                                    <span class="text-xs font-bold text-gray-600 group-hover:text-indigo-700">
                                                        #{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Content Card -->
                                            <div class="min-w-0 flex-1">
                                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 group-hover:bg-white group-hover:border-indigo-200 group-hover:shadow-md transition-all duration-200">
                                                    
                                                    <!-- User Info & Timestamp -->
                                                    <div class="flex items-center justify-between mb-3">
                                                        <div class="flex items-center space-x-3">
                                                            <!-- User Avatar -->
                                                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-sm">
                                                                <span class="text-xs font-bold text-white">
                                                                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                                                </span>
                                                            </div>
                                                            
                                                            <!-- User Name -->
                                                            <div>
                                                                <p class="text-sm font-semibold text-gray-900">
                                                                    {{ $log->user->name ?? 'System' }}
                                                                </p>
                                                                @if($log->user)
                                                                    <p class="text-xs text-gray-500">
                                                                        {{ $log->user->role->nama_role ?? '-' }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Timestamp -->
                                                        <div class="text-right">
                                                            <time class="text-xs font-medium text-gray-500 block" title="{{ $log->timestamp->format('d F Y, H:i:s') }}">
                                                                {{ $log->timestamp->diffForHumans() }}
                                                            </time>
                                                            <span class="text-xs text-gray-400">
                                                                {{ $log->timestamp->format('H:i') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Activity Description -->
                                                    <div class="flex items-start space-x-2">
                                                        <div class="flex-shrink-0 mt-0.5">
                                                            @php
                                                                $activity = strtolower($log->aktivitas);
                                                                $iconColor = 'text-gray-400';
                                                                $iconPath = 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z';
                                                                
                                                                if (str_contains($activity, 'login') || str_contains($activity, 'masuk')) {
                                                                    $iconColor = 'text-green-500';
                                                                    $iconPath = 'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1';
                                                                } elseif (str_contains($activity, 'logout') || str_contains($activity, 'keluar')) {
                                                                    $iconColor = 'text-red-500';
                                                                    $iconPath = 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1';
                                                                } elseif (str_contains($activity, 'tambah') || str_contains($activity, 'buat') || str_contains($activity, 'create')) {
                                                                    $iconColor = 'text-blue-500';
                                                                    $iconPath = 'M12 4v16m8-8H4';
                                                                } elseif (str_contains($activity, 'edit') || str_contains($activity, 'ubah') || str_contains($activity, 'update')) {
                                                                    $iconColor = 'text-amber-500';
                                                                    $iconPath = 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z';
                                                                } elseif (str_contains($activity, 'hapus') || str_contains($activity, 'delete')) {
                                                                    $iconColor = 'text-red-500';
                                                                    $iconPath = 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16';
                                                                } elseif (str_contains($activity, 'setuju') || str_contains($activity, 'approve')) {
                                                                    $iconColor = 'text-green-500';
                                                                    $iconPath = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
                                                                } elseif (str_contains($activity, 'tolak') || str_contains($activity, 'reject')) {
                                                                    $iconColor = 'text-red-500';
                                                                    $iconPath = 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z';
                                                                }
                                                            @endphp
                                                            
                                                            <svg class="w-5 h-5 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"/>
                                                            </svg>
                                                        </div>
                                                        <div class="flex-1">
                                                            <p class="text-sm text-gray-700 leading-relaxed">
                                                                {{ $log->aktivitas }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li>
                                    <div class="text-center py-16">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-base font-semibold text-gray-900 mb-2">Belum Ada Log Aktivitas</h3>
                                        <p class="text-sm text-gray-500 max-w-sm mx-auto">
                                            @if(request('search'))
                                                Tidak ada hasil untuk pencarian "{{ request('search') }}". Coba kata kunci lain.
                                            @else
                                                Log aktivitas akan muncul di sini ketika pengguna melakukan aksi di sistem.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <div class="mt-6">
                                                <a href="{{ route('admin.log.index') }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Reset Pencarian
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Pagination -->
                    @if($logs->hasPages())
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
