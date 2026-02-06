<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proses Pengembalian #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjaman -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Peminjaman</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Peminjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Rencana Kembali</p>
                            <p class="font-medium {{ $peminjaman->tanggal_kembali->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                @if($peminjaman->tanggal_kembali->isPast())
                                    (Terlambat {{ now()->diffInDays($peminjaman->tanggal_kembali) }} hari)
                                @endif
                            </p>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjaman->detail as $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Pengembalian -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Pengembalian</h3>
                    <form action="{{ route('petugas.pengembalian.store', $peminjaman) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Alat</label>
                            <select name="kondisi" id="kondisi" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik" {{ old('kondisi') === 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ old('kondisi') === 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('kondisi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="denda" class="block text-sm font-medium text-gray-700 mb-1">Denda (Rp)</label>
                            <input type="number" name="denda" id="denda" value="{{ old('denda', 0) }}" min="0" step="1000"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('denda')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" placeholder="Catatan tambahan (opsional)..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center space-x-3">
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium"
                                onclick="return confirm('Proses pengembalian?')">
                                Proses Pengembalian
                            </button>
                            <a href="{{ route('petugas.pengembalian.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
