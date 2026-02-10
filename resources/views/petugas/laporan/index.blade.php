<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Laporan Peminjaman</h2>
                <p class="mt-1 text-sm text-gray-600">Lihat dan cetak laporan aktivitas peminjaman</p>
            </div>
            <a href="{{ route('petugas.laporan.cetak', request()->query()) }}" target="_blank"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak PDF
            </a>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 p-5">
                    <form method="GET" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Dari Tanggal</label>
                            <input type="date" name="dari" value="{{ request('dari') }}"
                                class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Sampai Tanggal</label>
                            <input type="date" name="sampai" value="{{ request('sampai') }}"
                                class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Status</label>
                            <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                                <option value="">Semua Status</option>
                                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Dipinjam" {{ request('status') === 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Ditolak" {{ request('status') === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Selesai" {{ request('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 text-white rounded-lg text-sm font-medium transition-all">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filter
                            </button>
                            @if(request('dari') || request('sampai') || request('status'))
                                <a href="{{ route('petugas.laporan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg text-sm text-gray-700 font-medium transition-all">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-white">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <a href="{{ route('petugas.laporan.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        No
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
                                    <a href="{{ route('petugas.laporan.index', array_merge(request()->all(), ['sort_by' => 'tanggal_pinjam', 'sort_direction' => request('sort_by') == 'tanggal_pinjam' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
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
                                    <a href="{{ route('petugas.laporan.index', array_merge(request()->all(), ['sort_by' => 'tanggal_kembali', 'sort_direction' => request('sort_by') == 'tanggal_kembali' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Item</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <a href="{{ route('petugas.laporan.index', array_merge(request()->all(), ['sort_by' => 'status', 'sort_direction' => request('sort_by') == 'status' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center hover:text-indigo-600 transition-colors">
                                        Status
                                        @if(request('sort_by') == 'status')
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
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-600">Denda</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjamans as $i => $peminjaman)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $peminjamans->firstItem() + $i }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-9 w-9 flex-shrink-0">
                                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                    <span class="text-xs font-bold text-white">
                                                        {{ strtoupper(substr($peminjaman->user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-semibold text-gray-900">{{ $peminjaman->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $peminjaman->user->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($peminjaman->tanggal_pinjam)
                                            <div class="text-sm text-gray-900">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</div>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            @foreach($peminjaman->detail->take(3) as $detail)
                                                <span class="inline-flex items-center text-xs text-gray-600">
                                                    {{ $detail->alat->nama_alat }} <span class="text-gray-400 mx-1">({{ $detail->jumlah }})</span>{{ !$loop->last ? ',' : '' }}
                                                </span>
                                            @endforeach
                                            @if($peminjaman->detail->count() > 3)
                                                <span class="text-xs text-gray-500 italic">+{{ $peminjaman->detail->count() - 3 }} lainnya</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $statusConfig = [
                                                'Pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'ring' => 'ring-yellow-200', 'dot' => 'bg-yellow-500'],
                                                'Dipinjam' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'ring' => 'ring-blue-200', 'dot' => 'bg-blue-500'],
                                                'Ditolak' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'ring' => 'ring-red-200', 'dot' => 'bg-red-500'],
                                                'Selesai' => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'ring' => 'ring-green-200', 'dot' => 'bg-green-500'],
                                            ];
                                            $config = $statusConfig[$peminjaman->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'ring' => 'ring-gray-200', 'dot' => 'bg-gray-500'];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }} ring-1 {{ $config['ring'] }}">
                                            <span class="w-1.5 h-1.5 {{ $config['dot'] }} rounded-full mr-1.5"></span>
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        @if($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 ring-1 ring-red-200">
                                                Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 mb-2">
                                                @if(request('dari') || request('sampai') || request('status'))
                                                    Tidak Ada Hasil
                                                @else
                                                    Belum Ada Data Laporan
                                                @endif
                                            </h3>
                                            <p class="text-sm text-gray-500 max-w-sm">
                                                @if(request('dari') || request('sampai') || request('status'))
                                                    Tidak ada data peminjaman yang sesuai dengan filter. Coba ubah kriteria pencarian.
                                                @else
                                                    Data laporan peminjaman akan muncul di sini.
                                                @endif
                                            </p>
                                            @if(request('dari') || request('sampai') || request('status'))
                                                <a href="{{ route('petugas.laporan.index') }}" 
                                                   class="mt-4 inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Reset Filter
                                                </a>
                                            @endif
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
