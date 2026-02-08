<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Katalog Alat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter & Search -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4">
                    <form method="GET" class="flex flex-wrap gap-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alat..."
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm flex-1">
                        <select name="kategori_id" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">Cari</button>
                        <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Reset</a>
                    </form>
                </div>
            </div>

            <!-- Grid Alat -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($alats as $alat)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <!-- Image -->
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if($alat->gambar)
                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <!-- Content -->
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-semibold text-gray-900 mb-1">{{ $alat->nama_alat }}</h3>
                            <p class="text-xs text-indigo-600 font-medium mb-2">{{ $alat->kategori->nama_kategori }}</p>
                            <p class="text-sm text-gray-500 mb-3 flex-1">{{ Str::limit($alat->deskripsi, 80) }}</p>
                            <div class="space-y-2">
                                <span class="text-sm font-medium {{ $alat->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    Stok: {{ $alat->stok }}
                                </span>
                                @if($alat->stok > 0)
                                    <form action="{{ route('peminjam.cart.add', $alat) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="number" name="jumlah" value="1" min="1" max="{{ $alat->stok }}"
                                            class="w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs py-1.5">
                                        <button type="submit"
                                            class="flex-1 inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            Pinjam
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('peminjam.booking.create', $alat) }}"
                                        class="inline-flex items-center justify-center w-full px-3 py-1.5 text-xs font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Booking
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-6 text-center text-gray-500 rounded-lg shadow-sm">
                        Tidak ada alat ditemukan.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $alats->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
