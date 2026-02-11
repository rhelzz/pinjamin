<x-app-layout>
    <x-slot name="pageTitle">Detail Peminjaman</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm">
                        <li><a href="{{ route('admin.history.index') }}" class="text-gray-500 hover:text-indigo-600">History</a></li>
                        <li><svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                        <li class="text-gray-700 font-medium">Detail #{{ $peminjaman->id }}</li>
                    </ol>
                </nav>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Detail Peminjaman #{{ $peminjaman->id }}</h2>
            </div>
            <a href="{{ route('admin.history.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg text-sm font-medium text-gray-700 transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Status Peminjaman</h3>
                                <p class="text-sm text-gray-500 mt-1">ID Transaksi: #{{ $peminjaman->id }}</p>
                            </div>
                            @php
                                $statusConfig = [
                                    'Pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'Dipinjam' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                                    'Ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'Selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ];
                                $config = $statusConfig[$peminjaman->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                </svg>
                                {{ $peminjaman->status }}
                            </span>
                        </div>

                        @if($peminjaman->status === 'Ditolak' && $peminjaman->alasan_tolak)
                            <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm font-medium text-red-800">Alasan Penolakan:</p>
                                <p class="text-sm text-red-700 mt-1">{{ $peminjaman->alasan_tolak }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Peminjam Info -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Peminjam</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="h-14 w-14 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-xl font-bold text-white">
                                    {{ strtoupper(substr($peminjaman->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ '@' . $peminjaman->user->username }}</p>
                                <p class="text-sm text-gray-500">{{ $peminjaman->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-indigo-100 rounded-lg">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $peminjaman->tanggal_pinjam ? $peminjaman->tanggal_pinjam->format('d F Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-orange-100 rounded-lg">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Batas Pengembalian</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->tanggal_kembali->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Alat Dipinjam</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($peminjaman->detail as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($detail->alat->gambar)
                                                    <img src="{{ asset('storage/' . $detail->alat->gambar) }}" alt="{{ $detail->alat->nama_alat }}" class="h-10 w-10 rounded-lg object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <span class="ml-3 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $detail->alat->kategori->nama_kategori ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                                {{ $detail->jumlah }} unit
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pengembalian Info (if exists) -->
                @if($peminjaman->pengembalian)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-green-50 to-white border-b border-green-200 px-6 py-4">
                            <h3 class="text-lg font-semibold text-green-800">Informasi Pengembalian</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Dikembalikan</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->pengembalian->tanggal_dikembalikan->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kondisi</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->pengembalian->kondisi }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Denda</p>
                                    @if($peminjaman->pengembalian->denda > 0)
                                        <p class="text-lg font-semibold text-red-600">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-lg font-semibold text-green-600">Tidak ada denda</p>
                                    @endif
                                </div>
                            </div>
                            @if($peminjaman->pengembalian->catatan)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Catatan:</p>
                                    <p class="text-sm text-gray-700">{{ $peminjaman->pengembalian->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Approval Info -->
                @if($peminjaman->approver)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-semibold text-gray-900">Riwayat Proses</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $peminjaman->status === 'Ditolak' ? 'Ditolak' : 'Disetujui' }} oleh {{ $peminjaman->approver->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $peminjaman->approved_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            @if($peminjaman->returner)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Pengembalian diproses oleh {{ $peminjaman->returner->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $peminjaman->returned_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
