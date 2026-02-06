<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Review Peminjaman #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjam -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Peminjam</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
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
                            <p class="text-sm text-gray-500">Tanggal Rencana Kembali</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Item yang Dipinjam</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Stok Saat Ini</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjaman->detail as $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $detail->alat->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->jumlah }}</td>
                                    <td class="px-6 py-4 text-sm text-center {{ $detail->alat->stok >= $detail->jumlah ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $detail->alat->stok }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            @if($peminjaman->status === 'Pending')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex items-start space-x-4">
                        <!-- Approve -->
                        <form action="{{ route('petugas.approval.approve', $peminjaman) }}" method="POST"
                            onsubmit="return confirm('Setujui peminjaman ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium">
                                Setujui
                            </button>
                        </form>

                        <!-- Reject -->
                        <form action="{{ route('petugas.approval.reject', $peminjaman) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Tolak peminjaman ini?')">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-end space-x-3">
                                <div class="flex-1">
                                    <label for="alasan_tolak" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                                    <input type="text" name="alasan_tolak" id="alasan_tolak" required placeholder="Masukkan alasan..."
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                </div>
                                <button type="submit" class="inline-flex items-center px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium">
                                    Tolak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('petugas.approval.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
