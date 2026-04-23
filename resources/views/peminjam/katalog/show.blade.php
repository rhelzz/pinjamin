<x-app-layout>
    <x-slot name="pageTitle">{{ $buku->judul }}</x-slot>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('peminjam.katalog.index') }}" class="p-2 bg-white border border-gray-200 text-gray-400 hover:text-indigo-600 hover:border-indigo-100 rounded-xl transition-all group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h2 class="font-black text-xl text-gray-900 leading-none tracking-tight">Detail Buku</h2>
                </div>
            </div>
            
            <a href="{{ route('peminjam.cart.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-bold rounded-xl hover:bg-indigo-100 transition-all relative">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Keranjang
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-rose-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    
                    <!-- Left: Book Visual (Slightly Smaller) -->
                    <div class="md:w-[35%] bg-gray-50/50 p-8 flex flex-col items-center border-b md:border-b-0 md:border-r border-gray-100">
                        <div class="relative w-full aspect-[3/4] rounded-2xl overflow-hidden shadow-xl shadow-indigo-100/50 group mb-6">
                            @if($buku->gambar)
                                <img src="{{ asset('storage/' . $buku->gambar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center p-8 text-center text-indigo-300">
                                    <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-lg text-[9px] font-black text-indigo-600 shadow-sm uppercase tracking-widest">
                                    {{ $buku->genre->nama_genre }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full space-y-3">
                            <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-100 shadow-sm">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tersedia</span>
                                <span class="text-sm font-black text-gray-900">{{ $buku->stok }} <span class="text-[10px] text-gray-400 font-bold uppercase">Buku</span></span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-100 shadow-sm">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kondisi</span>
                                <span class="text-[10px] font-black text-emerald-500 uppercase">Sangat Baik</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Content & Actions (Integrated) -->
                    <div class="md:w-[65%] p-8 md:p-10 flex flex-col">
                        <div class="mb-6">
                            <h1 class="text-3xl font-black text-gray-900 mb-2 leading-tight tracking-tight">{{ $buku->judul }}</h1>
                            <p class="text-gray-500 font-bold flex items-center gap-2">
                                <span class="text-indigo-500">{{ $buku->penulis ?? 'Penulis Anonim' }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span>{{ $buku->penerbit ?? '-' }}</span>
                            </p>
                        </div>

                        <!-- Mini Info Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Tahun Terbit</p>
                                <p class="text-xs font-bold text-gray-700">{{ $buku->tahun_terbit ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[9px] font-black text-gray-400 uppercase mb-1">ISBN</p>
                                <p class="text-xs font-bold text-gray-700 font-mono">{{ $buku->isbn ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Action Zone (Now Sleek & Compact) -->
                        <div class="mb-10 p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                            @if($buku->stok > 0)
                                <form action="{{ route('peminjam.cart.add', $buku) }}" method="POST" class="flex flex-wrap items-center gap-4">
                                    @csrf
                                    <!-- Sleek Qty -->
                                    <div class="flex items-center bg-white rounded-xl p-1 border border-indigo-100 shadow-sm">
                                        <button type="button" onclick="decrementQty('qty_show')" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-indigo-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"/></svg>
                                        </button>
                                        <input type="number" name="jumlah" id="qty_show" value="1" min="1" max="{{ $buku->stok }}"
                                            class="w-10 bg-transparent border-none text-center text-sm font-black text-gray-900 focus:ring-0 p-0 pointer-events-none">
                                        <button type="button" onclick="incrementQty('qty_show', {{ $buku->stok }})" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-indigo-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                        </button>
                                    </div>

                                    <!-- Compact Button -->
                                    <button type="submit" class="flex-1 min-w-[200px] h-12 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center shadow-lg shadow-indigo-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Pinjam Buku Ini
                                    </button>
                                </form>
                            @else
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-xs font-bold text-rose-500 flex items-center italic">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        Maaf, stok sedang habis.
                                    </p>
                                    <a href="{{ route('peminjam.booking.create', $buku) }}" class="h-10 px-6 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl transition-all flex items-center">
                                        Booking Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Synopsis -->
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 flex items-center">
                                Sinopsis
                            </p>
                            <div class="text-sm text-gray-600 leading-relaxed font-medium italic bg-gray-50/50 p-5 rounded-2xl border-l-4 border-indigo-200">
                                @if($buku->deskripsi)
                                    {!! nl2br(e($buku->deskripsi)) !!}
                                @else
                                    <span class="text-gray-400">Deskripsi tidak tersedia.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function incrementQty(id, max) {
            const input = document.getElementById(id);
            const currentVal = parseInt(input.value);
            if (currentVal < max) {
                input.value = currentVal + 1;
            }
        }

        function decrementQty(id) {
            const input = document.getElementById(id);
            const currentVal = parseInt(input.value);
            if (currentVal > 1) {
                input.value = currentVal - 1;
            }
        }
    </script>

    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</x-app-layout>
