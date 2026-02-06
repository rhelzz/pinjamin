<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Approval Peminjaman</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjamans as $peminjaman)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-500">#{{ $peminjaman->id }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $peminjaman->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $peminjaman->detail->count() }} alat</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $peminjaman->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('petugas.approval.show', $peminjaman) }}" class="text-indigo-600 hover:text-indigo-900">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada peminjaman pending.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $peminjamans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
