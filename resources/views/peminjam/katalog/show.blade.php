<x-app-layout>
    <x-slot name="pageTitle">Detail Alat</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Alat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gray-200 flex items-center justify-center min-h-[250px]">
                        @if($alat->gambar)
                            <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    <div class="p-6 md:w-2/3">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $alat->nama_alat }}</h1>
                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-indigo-100 text-indigo-800 rounded-full mb-4">{{ $alat->kategori->nama_kategori }}</span>

                        <p class="text-gray-600 mb-4">{{ $alat->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                        <div class="mb-4">
                            <span class="text-lg font-semibold {{ $alat->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                Stok Tersedia: {{ $alat->stok }}
                            </span>
                        </div>

                        @if($alat->stok > 0)
                            <form action="{{ route('peminjam.cart.add', $alat) }}" method="POST" class="flex items-center space-x-3">
                                @csrf
                                <input type="number" name="jumlah" value="1" min="1" max="{{ $alat->stok }}"
                                    class="w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-md text-white text-sm bg-indigo-600 hover:bg-indigo-700">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <div class="space-y-3">
                                <p class="text-sm text-gray-600">Stok sedang kosong. Anda bisa melakukan booking untuk alat ini.</p>
                                <a href="{{ route('peminjam.booking.create', $alat) }}" 
                                    class="inline-flex items-center px-4 py-2 rounded-md text-white text-sm bg-amber-600 hover:bg-amber-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Booking Alat Ini
                                </a>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('peminjam.katalog.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali ke Katalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
