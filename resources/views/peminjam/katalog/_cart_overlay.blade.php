@php
    $cart = session('cart', []);
    $cartCount = count($cart);
    $bukus = \App\Models\Buku::whereIn('id', array_keys($cart))->get();
@endphp

@if($cartCount > 0)
    <!-- CART OVERLAY -->
    <div id="cartOverlay" class="fixed bottom-6 right-6 z-50 group p-2 -m-2">
        <!-- THE STATIC BRIDGE: This area stays active and doesn't scale, ensuring hover is never lost -->
        <div class="absolute bottom-full left-0 right-0 h-12 bg-transparent pointer-events-none group-hover:pointer-events-auto"></div>

        <!-- Hover Preview Panel -->
        <div class="absolute bottom-full right-2 mb-4 w-80 bg-white/95 backdrop-blur-xl border border-gray-100 rounded-[2.5rem] shadow-2xl overflow-hidden transition-all duration-300 origin-bottom-right scale-0 opacity-0 group-hover:scale-100 group-hover:opacity-100 invisible group-hover:visible pointer-events-none group-hover:pointer-events-auto">
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-900 text-lg">Isi Keranjang</h3>
                    <span class="text-xs font-bold text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full">{{ $cartCount }} Item</span>
                </div>

                <div class="space-y-4 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($bukus as $b)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-16 rounded-xl overflow-hidden bg-gray-50 flex-shrink-0 shadow-sm border border-gray-100">
                                @if($b->gambar)
                                    <img src="{{ asset('storage/' . $b->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $b->judul }}</p>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $b->genre->nama_genre }}</span>
                                    <span class="text-xs font-bold text-indigo-600">{{ $cart[$b->id]['jumlah'] }} Pcs</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <a href="{{ route('peminjam.cart.index') }}" class="flex items-center justify-center w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-1">
                        Ke Keranjang Pinjaman
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Floating Button -->
        <div class="relative flex items-center gap-3 bg-gray-900 text-white pl-4 pr-6 py-4 rounded-[2rem] shadow-2xl shadow-indigo-200 transition-all duration-300 group-hover:scale-105 cursor-pointer">
            <div class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-500 text-[10px] font-bold ring-2 ring-gray-900">
                    {{ $cartCount }}
                </span>
            </div>
            <div class="text-left">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Siap Pinjam</p>
                <p class="text-xs font-black">{{ $cartCount }} Judul Buku</p>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #d1d5db; }
    </style>
@endif
