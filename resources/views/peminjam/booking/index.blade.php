<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Booking</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Booking</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rencana Kembali</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($bookings as $booking)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $booking->alat->nama_alat }}</div>
                                                <div class="text-xs text-gray-500">{{ $booking->alat->kategori->nama_kategori ?? '-' }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $booking->jumlah }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->tanggal_booking->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->tanggal_kembali->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-center">
                                                @php
                                                    $statusColors = [
                                                        'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                                        'Disetujui' => 'bg-green-100 text-green-800',
                                                        'Ditolak' => 'bg-red-100 text-red-800',
                                                        'Selesai' => 'bg-gray-100 text-gray-800',
                                                    ];
                                                @endphp
                                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($booking->status === 'Menunggu')
                                                    <form action="{{ route('peminjam.booking.destroy', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan booking ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Batalkan</button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 mb-4">Belum ada booking.</p>
                            <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">
                                Lihat Katalog
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
