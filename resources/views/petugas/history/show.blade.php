<x-app-layout>
    <x-slot name="pageTitle">Detail Peminjaman</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Peminjaman #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjaman -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Peminjaman</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">ID Peminjaman</p>
                            <p class="font-medium text-gray-900">#{{ $peminjaman->id }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Dipinjam' => 'bg-blue-100 text-blue-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                    'Selesai' => 'bg-green-100 text-green-800',
                                ];
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$peminjaman->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $peminjaman->status }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Peminjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Username</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->username }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Rencana Kembali</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
                        </div>
                    </div>

                    @if($peminjaman->status === 'Ditolak' && $peminjaman->alasan_tolak)
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-red-800">Alasan Ditolak:</p>
                                    <p class="text-sm text-red-700 mt-1">{{ $peminjaman->alasan_tolak }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Petugas (Approver & Returner) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Proses</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Approver Info -->
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-blue-800">Disetujui/Ditolak Oleh</p>
                                    @if($peminjaman->approver)
                                        <p class="text-sm text-blue-900 font-medium">{{ $peminjaman->approver->name }}</p>
                                        <p class="text-xs text-blue-700">{{ $peminjaman->approved_at?->format('d M Y, H:i') }}</p>
                                    @else
                                        <p class="text-sm text-blue-600">Belum diproses</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Returner Info -->
                        <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-green-800">Pengembalian Diproses Oleh</p>
                                    @if($peminjaman->returner)
                                        <p class="text-sm text-green-900 font-medium">{{ $peminjaman->returner->name }}</p>
                                        <p class="text-xs text-green-700">{{ $peminjaman->returned_at?->format('d M Y, H:i') }}</p>
                                    @else
                                        <p class="text-sm text-green-600">Belum dikembalikan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Item Dipinjam</h3>
                        <span class="text-sm text-gray-500">Total: {{ $peminjaman->detail->count() }} jenis alat</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($peminjaman->detail as $index => $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $detail->alat->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <p class="line-clamp-2">{{ $detail->alat->deskripsi ?? '-' }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-semibold">
                                                {{ $detail->jumlah }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total Unit:</td>
                                    <td class="px-6 py-3 text-center text-sm font-bold text-gray-900">
                                        {{ $peminjaman->detail->sum('jumlah') }} unit
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pengembalian Info -->
            @if($peminjaman->pengembalian)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Pengembalian</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Dikembalikan</p>
                                <p class="font-medium text-gray-900">{{ $peminjaman->pengembalian->tanggal_dikembalikan->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kondisi</p>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $peminjaman->pengembalian->kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $peminjaman->pengembalian->kondisi }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Denda</p>
                                <p class="font-medium text-gray-900">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</p>
                            </div>
                            @if($peminjaman->pengembalian->catatan)
                                <div>
                                    <p class="text-sm text-gray-500">Catatan</p>
                                    <p class="font-medium text-gray-900">{{ $peminjaman->pengembalian->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <a href="{{ route('petugas.history.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali ke History</a>
        </div>
    </div>
</x-app-layout>
