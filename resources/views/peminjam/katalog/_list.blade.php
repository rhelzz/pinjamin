@if($viewMode === 'table')
    <!-- TABLE VIEW -->
    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center w-16">#</th>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Informasi Buku</th>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status/Stok</th>
                    <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pinjam</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($bukus as $buku)
                    <tr class="hover:bg-indigo-50/30 transition-colors">
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-bold text-gray-400">{{ ($bukus->currentPage()-1) * $bukus->perPage() + $loop->iteration }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-16 rounded-lg overflow-hidden flex-shrink-0 shadow-sm border border-gray-100 bg-gray-50">
                                    @if($buku->gambar)
                                        <img src="{{ asset('storage/' . $buku->gambar) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('peminjam.katalog.show', $buku) }}" class="text-sm font-bold text-gray-900 line-clamp-1 hover:text-indigo-600 transition-colors">{{ $buku->judul }}</a>
                                    <p class="text-xs text-gray-400">{{ $buku->penulis ?? 'Anonim' }} • {{ $buku->isbn ?? 'Tanpa ISBN' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full border border-indigo-100 uppercase tracking-tight">
                                {{ $buku->genre->nama_genre }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($buku->stok > 0)
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full border border-emerald-100 uppercase tracking-tight">
                                    {{ $buku->stok }} Tersedia
                                </span>
                            @else
                                <span class="px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded-full border border-rose-100 uppercase tracking-tight">
                                    Stok Habis
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                @if($buku->stok > 0)
                                    <form action="{{ route('peminjam.cart.add', $buku) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        <!-- Interactive Qty Selector -->
                                        <div class="flex items-center bg-gray-50 border border-gray-100 rounded-xl p-0.5 shadow-sm">
                                            <button type="button" onclick="decrementQty('qty_table_{{ $buku->id }}')" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/></svg>
                                            </button>
                                            <input type="number" name="jumlah" id="qty_table_{{ $buku->id }}" value="1" min="1" max="{{ $buku->stok }}"
                                                class="w-10 bg-transparent border-none text-center text-xs font-bold text-gray-900 focus:ring-0 p-0 pointer-events-none">
                                            <button type="button" onclick="incrementQty('qty_table_{{ $buku->id }}', {{ $buku->stok }})" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>

                                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold rounded-xl shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            Pinjam
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('peminjam.booking.create', $buku) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-[11px] font-bold rounded-xl shadow-lg shadow-amber-100 transition-all transform hover:-translate-y-0.5">
                                        <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Booking
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center text-gray-400 font-medium">Buku tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <!-- CARD VIEW -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($bukus as $buku)
            <div class="group bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-500 flex flex-col">
                <!-- Book Cover -->
                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" 
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-indigo-50/50 to-purple-50/50 flex flex-col items-center justify-center p-4 text-center">
                            <svg class="w-12 h-12 text-indigo-100 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="text-[10px] font-bold text-indigo-200 uppercase tracking-tighter line-clamp-2 px-2">{{ $buku->judul }}</span>
                        </div>
                    @endif
                    
                    <!-- Genre Overlay -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/80 backdrop-blur-md rounded-full text-[9px] font-bold text-indigo-600 shadow-sm border border-indigo-50 uppercase tracking-wider">
                            {{ $buku->genre->nama_genre }}
                        </span>
                    </div>

                    <!-- Stock Indicator -->
                    <div class="absolute bottom-4 right-4">
                        <span class="px-2.5 py-1.5 {{ $buku->stok > 0 ? 'bg-emerald-500' : 'bg-rose-500' }} rounded-xl text-white text-[10px] font-bold shadow-lg shadow-indigo-100/20">
                            {{ $buku->stok > 0 ? $buku->stok . ' Stok' : 'Habis' }}
                        </span>
                    </div>
                </div>

                <!-- Book Content -->
                <div class="p-5 flex flex-col flex-1 bg-white">
                    <h3 class="text-sm font-bold text-gray-900 leading-tight mb-2 line-clamp-2 h-10 group-hover:text-indigo-600 transition-colors" title="{{ $buku->judul }}">
                        <a href="{{ route('peminjam.katalog.show', $buku) }}">{{ $buku->judul }}</a>
                    </h3>
                    
                    <p class="text-[11px] text-gray-400 flex items-center mb-4">
                        <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full mr-2"></span>
                        <span class="truncate">{{ $buku->penulis ?? 'Anonim' }}</span>
                    </p>

                    <!-- Actions -->
                    <div class="mt-auto space-y-3">
                        @if($buku->stok > 0)
                            <form action="{{ route('peminjam.cart.add', $buku) }}" method="POST" class="space-y-3">
                                @csrf
                                <!-- Modern Qty Selector -->
                                <div class="flex items-center justify-between bg-gray-50 border border-gray-100 rounded-2xl p-1 shadow-inner">
                                    <button type="button" onclick="decrementQty('qty_card_{{ $buku->id }}')" class="w-10 h-10 flex items-center justify-center bg-white text-gray-400 hover:text-indigo-600 shadow-sm rounded-xl transition-all active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/></svg>
                                    </button>
                                    <div class="flex flex-col items-center">
                                        <input type="number" name="jumlah" id="qty_card_{{ $buku->id }}" value="1" min="1" max="{{ $buku->stok }}"
                                            class="w-12 bg-transparent border-none text-center text-sm font-black text-gray-900 focus:ring-0 p-0 pointer-events-none">
                                        <span class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Qty</span>
                                    </div>
                                    <button type="button" onclick="incrementQty('qty_card_{{ $buku->id }}', {{ $buku->stok }})" class="w-10 h-10 flex items-center justify-center bg-white text-gray-400 hover:text-indigo-600 shadow-sm rounded-xl transition-all active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    </button>
                                </div>

                                <button type="submit" class="w-full flex items-center justify-center h-12 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Tambahkan Pinjaman
                                </button>
                            </form>
                        @else
                            <a href="{{ route('peminjam.booking.create', $buku) }}" class="w-full inline-flex items-center justify-center h-12 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-2xl shadow-lg shadow-amber-100 transition-all transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Booking Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-[2rem] mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Buku tidak ditemukan</h3>
                <p class="text-sm text-gray-400 max-w-xs mx-auto">Coba cari dengan kata kunci lain atau pilih genre yang berbeda.</p>
            </div>
        @endforelse
    </div>
@endif

<!-- Bottom Pagination -->
<div class="mt-12 flex justify-center ajax-pagination">
    {{ $bukus->links() }}
</div>
