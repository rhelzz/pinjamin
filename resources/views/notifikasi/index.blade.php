<x-app-layout>
    <x-slot name="pageTitle">Notifikasi</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-xl text-gray-900 leading-tight">Notifikasi</h2>
                <p class="mt-0.5 text-xs text-gray-600">Kelola semua pemberitahuan Anda</p>
            </div>
            <div class="flex items-center gap-2">
                @if($stats['unread'] > 0)
                    <form action="{{ route('notifikasi.readAll') }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg shadow-sm transition-all">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
                @if($stats['total'] > 0)
                    <form action="{{ route('notifikasi.destroyAll') }}" method="POST" class="inline" data-confirm="Hapus semua notifikasi?" data-confirm-title="Konfirmasi Hapus Semua" data-confirm-type="danger">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg shadow-sm transition-all">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Semua
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Cards (Responsive Grid) -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 mb-4">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-3 md:p-4">
                    <div class="flex items-center gap-2 md:gap-3">
                        <div class="p-2 bg-indigo-100 rounded-lg hidden sm:block">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-tight">Total</p>
                            <p class="text-base md:text-lg font-black text-gray-900">{{ number_format($stats['total']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-3 md:p-4">
                    <div class="flex items-center gap-2 md:gap-3">
                        <div class="p-2 bg-amber-100 rounded-lg hidden sm:block">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-tight">Baru</p>
                            <p class="text-base md:text-lg font-black text-amber-600">{{ number_format($stats['unread']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-3 md:p-4 col-span-2 md:col-span-1">
                    <div class="flex items-center gap-2 md:gap-3">
                        <div class="p-2 bg-green-100 rounded-lg hidden sm:block">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-tight">Dibaca</p>
                            <p class="text-base md:text-lg font-black text-green-600">{{ number_format($stats['read']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter (Responsive) -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 overflow-hidden">
                <div class="p-3 md:p-4">
                    <form method="GET" class="flex flex-col sm:flex-row gap-2">
                        <div class="grid grid-cols-2 sm:flex gap-2 flex-1">
                            <select name="genre" class="rounded-lg border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs py-2 bg-gray-50/50">
                                <option value="">Genre</option>
                                <option value="peminjaman" {{ request('genre') === 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                                <option value="pengembalian" {{ request('genre') === 'pengembalian' ? 'selected' : '' }}>Pengembalian</option>
                                <option value="denda" {{ request('genre') === 'denda' ? 'selected' : '' }}>Denda</option>
                            </select>
                            <select name="status" class="rounded-lg border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs py-2 bg-gray-50/50">
                                <option value="">Status</option>
                                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Baru</option>
                                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Dibaca</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-gray-900 text-white text-xs font-bold rounded-lg transition-all">
                                Filter
                            </button>
                            @if(request()->hasAny(['genre', 'status']))
                                <a href="{{ route('notifikasi.index') }}" class="inline-flex items-center justify-center p-2 bg-white border border-gray-200 text-gray-500 rounded-lg hover:bg-gray-50 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notifikasi List -->
            <div class="space-y-3">
                @forelse($notifikasis as $notifikasi)
                    @php
                        $pesan = strtolower($notifikasi->pesan);
                        $genre = 'Sistem';
                        $kategoriColor = 'gray';
                        $kategoriIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>';
                        
                        if (str_contains($pesan, 'peminjaman') || str_contains($pesan, 'pinjam') || str_contains($pesan, 'disetujui') || str_contains($pesan, 'ditolak') || str_contains($pesan, 'approve')) {
                            $genre = 'Pinjam';
                            $kategoriColor = 'blue';
                            $kategoriIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>';
                        } elseif (str_contains($pesan, 'pengembalian') || str_contains($pesan, 'dikembalikan') || str_contains($pesan, 'kembali')) {
                            $genre = 'Kembali';
                            $kategoriColor = 'green';
                            $kategoriIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>';
                        } elseif (str_contains($pesan, 'denda') || str_contains($pesan, 'terlambat') || str_contains($pesan, 'keterlambatan')) {
                            $genre = 'Denda';
                            $kategoriColor = 'red';
                            $kategoriIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                        }
                    @endphp
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl border {{ !$notifikasi->is_read ? 'border-indigo-300 bg-indigo-50/30' : 'border-gray-200' }}">
                        <div class="p-3 md:p-4 flex items-start gap-3">
                            <div class="flex-shrink-0 w-9 h-9 md:w-10 md:h-10 rounded-full flex items-center justify-center
                                @if($kategoriColor === 'blue') bg-blue-100 text-blue-600
                                @elseif($kategoriColor === 'green') bg-green-100 text-green-600
                                @elseif($kategoriColor === 'red') bg-red-100 text-red-600
                                @else bg-gray-100 text-gray-600
                                @endif transition-transform group-hover:scale-110">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $kategoriIcon !!}</svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-tight
                                        @if($kategoriColor === 'blue') bg-blue-50 text-blue-700
                                        @elseif($kategoriColor === 'green') bg-green-50 text-green-700
                                        @elseif($kategoriColor === 'red') bg-red-50 text-red-700
                                        @else bg-gray-50 text-gray-700
                                        @endif">
                                        {{ $genre }}
                                    </span>
                                    @if(!$notifikasi->is_read)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-amber-50 text-amber-700">Baru</span>
                                    @endif
                                </div>
                                <p class="text-xs md:text-sm {{ !$notifikasi->is_read ? 'font-bold text-gray-900' : 'text-gray-600' }} leading-relaxed">
                                    {{ $notifikasi->pesan }}
                                </p>
                                <p class="text-[10px] text-gray-400 mt-1 font-medium italic">{{ $notifikasi->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-1">
                                @if(!$notifikasi->is_read)
                                    <form action="{{ route('notifikasi.read', $notifikasi->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Baca">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-8 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Belum Ada Notifikasi</h3>
                            <p class="text-xs text-gray-500">
                                @if(request()->hasAny(['genre', 'status']))
                                    Tidak ada notifikasi dengan filter yang dipilih.
                                @else
                                    Notifikasi akan muncul di sini ketika ada aktivitas terkait akun Anda.
                                @endif
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($notifikasis->hasPages())
                <div class="mt-4">
                    {{ $notifikasis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
