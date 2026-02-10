<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Pengembalian Alat</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola proses pengembalian alat yang dipinjam</p>
            </div>
            @if($peminjamans->count() > 0)
                <span class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full ring-1 ring-blue-200">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    {{ $peminjamans->total() }} Peminjaman Aktif
                </span>
            @endif
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-white">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <a href="{{ route('petugas.pengembalian.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        ID
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Peminjam</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <a href="{{ route('petugas.pengembalian.index', array_merge(request()->all(), ['sort_by' => 'tanggal_pinjam', 'sort_direction' => request('sort_by') == 'tanggal_pinjam' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        Tanggal Pinjam
                                        @if(request('sort_by') == 'tanggal_pinjam')
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <a href="{{ route('petugas.pengembalian.index', array_merge(request()->all(), ['sort_by' => 'tanggal_kembali', 'sort_direction' => request('sort_by') == 'tanggal_kembali' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        Tanggal Kembali
                                        @if(request('sort_by') == 'tanggal_kembali')
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
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Item</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Status</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjamans as $peminjaman)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $peminjaman->tanggal_kembali->isPast() ? 'bg-red-50/50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 font-mono">
                                            #{{ $peminjaman->id }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                    <span class="text-sm font-bold text-white">
                                                        {{ strtoupper(substr($peminjaman->user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ $peminjaman->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $peminjaman->user->username }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($peminjaman->tanggal_pinjam)
                                            <div class="text-sm text-gray-900">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $peminjaman->tanggal_pinjam->diffForHumans() }}</div>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm {{ $peminjaman->tanggal_kembali->isPast() ? 'text-red-600 font-semibold' : 'text-gray-900' }}">
                                            {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                        </div>
                                        @if($peminjaman->tanggal_kembali->isPast())
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-700 mt-1">
                                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></span>
                                                Terlambat {{ $peminjaman->tanggal_kembali->diffInDays(now()) }} hari
                                            </span>
                                        @else
                                            <div class="text-xs text-gray-500">{{ now()->diffInDays($peminjaman->tanggal_kembali) }} hari lagi</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                                            {{ $peminjaman->detail->count() }} alat
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 ring-1 ring-blue-200">
                                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                            Dipinjam
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('petugas.pengembalian.create', $peminjaman) }}" 
                                           class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-xs font-semibold rounded-lg transition-all duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Proses Kembali
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 mb-2">Tidak Ada Peminjaman Aktif</h3>
                                            <p class="text-sm text-gray-500 max-w-sm">
                                                Semua peminjaman telah dikembalikan. Peminjaman aktif akan muncul di sini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($peminjamans->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $peminjamans->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
