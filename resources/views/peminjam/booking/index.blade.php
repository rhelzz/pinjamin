<x-app-layout>
    <x-slot name="pageTitle">Booking</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Daftar Booking</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola daftar reservasi buku Anda</p>
            </div>
            <a href="{{ route('peminjam.katalog.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Booking Baru
            </a>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-white">
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                        <a href="{{ route('peminjam.booking.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                            No
                                            @if(request('sort_by') == 'id' || !request('sort_by'))
                                                @if(request('sort_direction') == 'desc')
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                                @else
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">Buku</th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Jumlah</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                        <a href="{{ route('peminjam.booking.index', array_merge(request()->all(), ['sort_by' => 'tanggal_booking', 'sort_direction' => request('sort_by') == 'tanggal_booking' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                            Tanggal Booking
                                            @if(request('sort_by') == 'tanggal_booking')
                                                @if(request('sort_direction') == 'asc')
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                                @else
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                        <a href="{{ route('peminjam.booking.index', array_merge(request()->all(), ['sort_by' => 'tanggal_kembali', 'sort_direction' => request('sort_by') == 'tanggal_kembali' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                            Rencana Kembali
                                            @if(request('sort_by') == 'tanggal_kembali')
                                                @if(request('sort_direction') == 'asc')
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                                @else
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">
                                        <a href="{{ route('peminjam.booking.index', array_merge(request()->all(), ['sort_by' => 'status', 'sort_direction' => request('sort_by') == 'status' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center hover:text-indigo-600 transition-colors">
                                            Status
                                            @if(request('sort_by') == 'status')
                                                @if(request('sort_direction') == 'asc')
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>
                                                @else
                                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 ml-1 opacity-30" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    @if($booking->buku->gambar)
                                                        <img src="{{ asset('storage/' . $booking->buku->gambar) }}" alt="{{ $booking->buku->judul }}" class="h-10 w-10 rounded-lg object-cover">
                                                    @else
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $booking->buku->judul }}</div>
                                                    <div class="text-xs text-gray-500">{{ $booking->buku->genre->nama_genre ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                                                {{ $booking->jumlah }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $booking->tanggal_booking->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->tanggal_booking->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $booking->tanggal_kembali->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                $statusConfig = [
                                                    'Menunggu' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'ring' => 'ring-yellow-200', 'dot' => 'bg-yellow-500'],
                                                    'Disetujui' => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'ring' => 'ring-green-200', 'dot' => 'bg-green-500'],
                                                    'Ditolak' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'ring' => 'ring-red-200', 'dot' => 'bg-red-500'],
                                                    'Selesai' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'ring' => 'ring-gray-200', 'dot' => 'bg-gray-500'],
                                                ];
                                                $config = $statusConfig[$booking->status] ?? $statusConfig['Selesai'];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }} ring-1 {{ $config['ring'] }}">
                                                <span class="w-1.5 h-1.5 {{ $config['dot'] }} rounded-full mr-1.5"></span>
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($booking->status === 'Menunggu')
                                                <form action="{{ route('peminjam.booking.destroy', $booking) }}" method="POST" class="inline" data-confirm="Batalkan booking ini?" data-confirm-title="Konfirmasi Pembatalan" data-confirm-type="danger">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        Batalkan
                                                    </button>
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

                    @if($bookings->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 mb-2">Belum Ada Booking</h3>
                        <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
                            Anda belum memiliki reservasi buku. Jelajahi katalog untuk melakukan booking.
                        </p>
                        <a href="{{ route('peminjam.katalog.index') }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-sm transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Lihat Katalog
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
