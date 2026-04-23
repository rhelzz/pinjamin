<x-app-layout>
    <x-slot name="pageTitle">Detail Buku - {{ $buku->judul }}</x-slot>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.buku.index') }}" class="p-2.5 bg-white border border-gray-200 text-gray-400 hover:text-indigo-600 hover:border-indigo-100 rounded-xl transition-all shadow-sm group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <nav class="flex mb-1" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a></li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                                <a href="{{ route('admin.buku.index') }}" class="hover:text-indigo-600 transition-colors">Koleksi</a>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="font-black text-2xl text-gray-900 leading-none tracking-tight">Informasi Koleksi</h2>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.buku.destroy', $buku) }}" method="POST" onsubmit="return confirm('Hapus buku permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-rose-100 text-rose-500 text-sm font-bold rounded-2xl hover:bg-rose-50 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.buku.edit', $buku) }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Visual -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-4 rounded-[2.5rem] border border-gray-100 shadow-sm">
                        <div class="relative aspect-[3/4] rounded-[2rem] overflow-hidden shadow-2xl bg-gray-50 group">
                            @if($buku->gambar)
                                <img src="{{ asset('storage/' . $buku->gambar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-50 to-purple-50 flex flex-col items-center justify-center p-8 text-center">
                                    <svg class="w-20 h-20 text-indigo-100 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <span class="text-[10px] font-black text-indigo-200 uppercase tracking-[0.2em]">{{ $buku->judul }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Inventory Status -->
                    <div class="bg-gray-900 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-100/20">
                        <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-6">Status Inventaris</p>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400 text-sm font-medium">Stok Saat Ini</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-3xl font-black {{ $buku->stok > 0 ? 'text-white' : 'text-rose-500' }}">{{ $buku->stok }}</span>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Unit</span>
                                </div>
                            </div>
                            <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 rounded-full" style="width: {{ min(($buku->stok / 50) * 100, 100) }}%"></div>
                            </div>
                            <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                                <p class="text-[10px] text-gray-500 font-bold mb-1 uppercase tracking-wide">ID Buku</p>
                                <p class="text-sm font-mono text-indigo-300">#BKU-{{ str_pad($buku->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Main Info -->
                    <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 lg:p-12 shadow-sm">
                        <div class="mb-10">
                            <span class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-full border border-indigo-100 uppercase tracking-widest mb-6">
                                📁 {{ $buku->genre->nama_genre }}
                            </span>
                            <h1 class="text-4xl font-black text-gray-900 mb-4 leading-tight tracking-tight">{{ $buku->judul }}</h1>
                            <p class="text-lg text-gray-500 font-medium italic">"{{ $buku->penulis ?? 'Penulis Anonim' }}"</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                            <div class="group">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500 transition-colors">Penerbit</p>
                                <div class="flex items-center text-gray-900">
                                    <svg class="w-4 h-4 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span class="text-sm font-bold">{{ $buku->penerbit ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="group">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500 transition-colors">Tahun Terbit</p>
                                <div class="flex items-center text-gray-900">
                                    <svg class="w-4 h-4 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-bold">{{ $buku->tahun_terbit ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="group">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500 transition-colors">Kode ISBN</p>
                                <div class="flex items-center text-gray-900">
                                    <svg class="w-4 h-4 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                    <span class="text-sm font-bold font-mono">{{ $buku->isbn ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 border-t border-gray-50">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center">
                                <span class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></span>
                                Sinopsis Koleksi
                            </p>
                            <div class="prose prose-indigo max-w-none">
                                <p class="text-gray-600 leading-relaxed font-medium">
                                    @if($buku->deskripsi)
                                        {!! nl2br(e($buku->deskripsi)) !!}
                                    @else
                                        <span class="text-gray-400 italic font-normal">Deskripsi belum ditambahkan untuk buku ini.</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Data -->
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-gray-50 rounded-2xl">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">Waktu Input</p>
                                <p class="text-xs font-bold text-gray-700">{{ $buku->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-gray-50 rounded-2xl">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">Pembaruan Terakhir</p>
                                <p class="text-xs font-bold text-gray-700">{{ $buku->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
