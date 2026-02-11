<x-app-layout>
    <x-slot name="pageTitle">Keranjang</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Keranjang Peminjaman</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola daftar alat yang akan dipinjam</p>
            </div>
            <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-semibold rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($alats->count() > 0)
                <!-- Cart Table -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-white">
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Alat</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Kategori</th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Jumlah</th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Stok</th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($alats as $alat)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    @if($alat->gambar)
                                                        <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="h-10 w-10 rounded-lg object-cover">
                                                    @else
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $alat->nama_alat }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">
                                                {{ $alat->kategori->nama_kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('peminjam.cart.update', $alat) }}" method="POST" class="flex items-center justify-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="jumlah" value="{{ $cart[$alat->id]['jumlah'] }}" min="1" max="{{ $alat->stok }}"
                                                    class="w-16 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm text-center py-2">
                                                <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $alat->stok > 3 ? 'bg-green-50 text-green-700 ring-1 ring-green-200' : 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200' }}">
                                                {{ $alat->stok }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <form action="{{ route('peminjam.cart.remove', $alat) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ajukan Peminjaman</h3>
                        <p class="text-sm text-gray-500 mt-1">Lengkapi informasi untuk mengajukan peminjaman</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('peminjam.cart.checkout') }}" method="POST">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Tanggal Peminjaman (Readonly) -->
                                <div>
                                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Peminjaman
                                    </label>
                                    <input type="date" id="tanggal_pinjam"
                                        value="{{ date('Y-m-d') }}"
                                        readonly
                                        class="w-full rounded-lg border-gray-300 bg-gray-50 text-gray-600 shadow-sm cursor-not-allowed">
                                    <p class="mt-2 text-xs text-gray-500">Tanggal peminjaman akan dicatat saat petugas menyetujui</p>
                                </div>

                                <!-- Tanggal Rencana Kembali -->
                                <div>
                                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Rencana Kembali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                        value="{{ old('tanggal_kembali') }}"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('tanggal_kembali')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="mb-6 p-5 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border border-indigo-100">
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-sm font-semibold text-gray-900">Ringkasan Peminjaman</h4>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white rounded-lg p-3 border border-indigo-100">
                                        <p class="text-xs text-gray-500 mb-1">Total Item</p>
                                        <p class="text-lg font-bold text-indigo-600">{{ count($cart) }} <span class="text-sm font-normal text-gray-500">jenis alat</span></p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-indigo-100">
                                        <p class="text-xs text-gray-500 mb-1">Total Unit</p>
                                        <p class="text-lg font-bold text-indigo-600">{{ array_sum(array_column($cart, 'jumlah')) }} <span class="text-sm font-normal text-gray-500">unit</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <p class="text-xs text-gray-500">Pastikan data sudah benar sebelum mengajukan</p>
                                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white rounded-lg font-semibold shadow-sm hover:shadow-md transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Ajukan Peminjaman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Keranjang Kosong</h3>
                    <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
                        Belum ada alat yang ditambahkan ke keranjang. Jelajahi katalog untuk meminjam alat.
                    </p>
                    <a href="{{ route('peminjam.katalog.index') }}" 
                       class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-sm transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Lihat Katalog Alat
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
