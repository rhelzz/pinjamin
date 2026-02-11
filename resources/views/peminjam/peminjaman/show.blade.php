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
                            <p class="text-sm text-gray-500">Peminjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->created_at->format('d M Y, H:i') }}</p>
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

                    @if($peminjaman->status === 'Pending')
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-yellow-800">Menunggu Persetujuan</p>
                                    <p class="text-xs text-yellow-700 mt-1">Peminjaman Anda sedang dalam proses review oleh petugas</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Info Petugas -->
                    @if($peminjaman->approver || $peminjaman->returner)
                        <div class="mt-4 border-t border-gray-200 pt-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Informasi Proses</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($peminjaman->approver)
                                    <div class="p-3 bg-blue-50 rounded-lg">
                                        <p class="text-xs text-blue-600 font-medium">{{ $peminjaman->status === 'Ditolak' ? 'Ditolak' : 'Disetujui' }} Oleh</p>
                                        <p class="text-sm font-semibold text-blue-900">{{ $peminjaman->approver->name }}</p>
                                        <p class="text-xs text-blue-700">{{ $peminjaman->approved_at?->format('d M Y, H:i') }}</p>
                                    </div>
                                @endif
                                @if($peminjaman->returner)
                                    <div class="p-3 bg-green-50 rounded-lg">
                                        <p class="text-xs text-green-600 font-medium">Pengembalian Diproses Oleh</p>
                                        <p class="text-sm font-semibold text-green-900">{{ $peminjaman->returner->name }}</p>
                                        <p class="text-xs text-green-700">{{ $peminjaman->returned_at?->format('d M Y, H:i') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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

            <!-- Pengembalian Info (if returned) -->
            @if($peminjaman->pengembalian)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Pengembalian</h3>
                        <div class="grid grid-cols-2 gap-4">
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

            <a href="{{ route('peminjam.peminjaman.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali ke Riwayat</a>
        </div>
    </div>
</x-app-layout>
