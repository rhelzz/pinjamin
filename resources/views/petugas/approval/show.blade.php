<x-app-layout>
    <x-slot name="pageTitle">Detail Persetujuan</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Review Peminjaman #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjam -->
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
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
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
                            <p class="text-sm text-gray-500">Role</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->role->nama_role ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Rencana Kembali</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Durasi Peminjaman</p>
                            @php
                                $durasi = max(0, (int) abs($peminjaman->tanggal_kembali->startOfDay()->floatDiffInDays(now()->startOfDay())));
                            @endphp
                            <p class="font-medium text-gray-900">{{ $durasi }} hari</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Item yang Dipinjam</h3>
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
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pinjam</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Tersedia</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($peminjaman->detail as $index => $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $detail->alat->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                            <p class="line-clamp-2">{{ $detail->alat->deskripsi ?? '-' }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center">
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-800 font-bold">
                                                {{ $detail->jumlah }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center font-semibold {{ $detail->alat->stok >= $detail->jumlah ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $detail->alat->stok }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($detail->alat->stok >= $detail->jumlah)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Stok Kurang
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total Unit yang Dipinjam:</td>
                                    <td class="px-6 py-3 text-center text-sm font-bold text-gray-900">
                                        {{ $peminjaman->detail->sum('jumlah') }} unit
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            @php
                $stokTidakCukup = $peminjaman->detail->filter(function($detail) {
                    return $detail->alat->stok < $detail->jumlah;
                })->count();
            @endphp

            <!-- Action Buttons -->
            @if($peminjaman->status === 'Pending')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tindakan Persetujuan</h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Approve Section -->
                            <div class="border-2 border-green-200 rounded-lg p-5 bg-green-50 hover:border-green-300 transition-all">
                                <div class="flex items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-base font-semibold text-gray-900 mb-1">Setujui Peminjaman</h4>
                                        <p class="text-sm text-gray-600">
                                            Dengan menyetujui, stok alat akan dikurangi dan peminjaman akan diproses.
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ route('petugas.approval.approve', $peminjaman) }}" method="POST"
                                    data-confirm="Setujui peminjaman ini?"
                                    data-confirm-title="Konfirmasi Persetujuan"
                                    data-confirm-type="success">
                                    @csrf
                                    <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 font-semibold transition-colors shadow-sm">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Setujui Peminjaman
                                    </button>
                                </form>
                            </div>

                            <!-- Reject Section -->
                            <div class="border-2 border-red-200 rounded-lg p-5 bg-red-50 hover:border-red-300 transition-all">
                                <div class="flex items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-base font-semibold text-gray-900 mb-1">Tolak Peminjaman</h4>
                                        <p class="text-sm text-gray-600">
                                            Berikan alasan penolakan yang jelas kepada peminjam.
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ route('petugas.approval.reject', $peminjaman) }}" method="POST"
                                    data-confirm="Tolak peminjaman ini?"
                                    data-confirm-title="Konfirmasi Penolakan"
                                    data-confirm-type="danger">
                                    @csrf
                                    <div class="space-y-3">
                                        <div>
                                            <label for="alasan_tolak" class="block text-sm font-medium text-gray-700 mb-2">
                                                Alasan Penolakan <span class="text-red-500">*</span>
                                            </label>
                                            <textarea name="alasan_tolak" id="alasan_tolak" rows="3" required 
                                                placeholder="Contoh: Stok tidak mencukupi, alat sedang dalam perbaikan, dll..."
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm resize-none"></textarea>
                                        </div>
                                        <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 font-semibold transition-colors shadow-sm">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak Peminjaman
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if($stokTidakCukup > 0)
                            <div class="mt-5 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-yellow-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-yellow-800">Rekomendasi: Tolak Peminjaman</p>
                                        <p class="text-sm text-yellow-700 mt-0.5">
                                            Terdapat {{ $stokTidakCukup }} item dengan stok tidak mencukupi. Pertimbangkan untuk menolak atau hubungi peminjam untuk menyesuaikan jumlah.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('petugas.approval.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
