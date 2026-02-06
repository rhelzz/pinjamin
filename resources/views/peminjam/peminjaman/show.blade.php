<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Peminjaman #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjaman -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
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
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$peminjaman->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $peminjaman->status }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->created_at->format('d M Y H:i') }}</p>
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
                        <div class="mt-4 p-3 bg-red-50 rounded-md">
                            <p class="text-sm font-medium text-red-800">Alasan Ditolak:</p>
                            <p class="text-sm text-red-700">{{ $peminjaman->alasan_tolak }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Detail Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Item Dipinjam</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjaman->detail as $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $detail->alat->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
