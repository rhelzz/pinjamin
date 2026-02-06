<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Keranjang Peminjaman</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($alats->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok Tersedia</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($alats as $alat)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $alat->kategori->nama_kategori }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('peminjam.cart.update', $alat) }}" method="POST" class="flex items-center justify-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="jumlah" value="{{ $cart[$alat->id]['jumlah'] }}" min="1" max="{{ $alat->stok }}"
                                                    class="w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm text-center">
                                                <button type="submit" class="text-indigo-600 hover:text-indigo-800 text-xs">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $alat->stok }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('peminjam.cart.remove', $alat) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ajukan Peminjaman</h3>
                        <form action="{{ route('peminjam.cart.checkout') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Rencana Kembali</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                    value="{{ old('tanggal_kembali') }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('tanggal_kembali')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium">
                                Ajukan Peminjaman
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        <p class="text-gray-500 mb-4">Keranjang kosong.</p>
                        <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">
                            Lihat Katalog Alat
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
