<x-app-layout>
    <x-slot name="pageTitle">Koleksi Buku</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight tracking-tight">Koleksi Buku</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                        {{ $bukus->total() }} Total Buku
                    </span>
                    <p class="text-sm text-gray-400 font-medium">dalam sistem inventaris</p>
                </div>
            </div>
            <a href="{{ route('admin.buku.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter & Switcher Section -->
            <div class="bg-white/70 backdrop-blur-md border border-gray-100 rounded-[2rem] p-6 mb-8 shadow-sm transition-all duration-300">
                <form method="GET" class="flex flex-col lg:flex-row items-center gap-4">
                    <!-- Keep current view mode in form -->
                    <input type="hidden" name="view" value="{{ $viewMode }}">

                    <!-- Search -->
                    <div class="flex-1 w-full">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Cari judul, penulis..." 
                                class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border-transparent rounded-[1.5rem] text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-400 focus:bg-white transition-all outline-none">
                        </div>
                    </div>
                    
                    <!-- Filters & View Switcher -->
                    <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 w-full lg:w-auto">
                        <select name="genre_id" 
                            class="flex-1 lg:w-48 pl-4 pr-10 py-3 bg-gray-50/50 border-transparent rounded-[1.5rem] text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-400 focus:bg-white transition-all appearance-none outline-none">
                            <option value="">📁 Semua Genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->nama_genre }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 text-white font-bold rounded-[1.5rem] hover:bg-black transition-all">
                            Cari
                        </button>

                        <!-- VIEW SWITCHER -->
                        <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-2xl border border-gray-200">
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'card', 'page' => 1]) }}" 
                               class="p-2 rounded-xl transition-all {{ $viewMode === 'card' ? 'bg-white shadow-sm text-indigo-600' : 'text-gray-400 hover:text-gray-600' }}"
                               title="Tampilan Kartu">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'table', 'page' => 1]) }}" 
                               class="p-2 rounded-xl transition-all {{ $viewMode === 'table' ? 'bg-white shadow-sm text-indigo-600' : 'text-gray-400 hover:text-gray-600' }}"
                               title="Tampilan Tabel">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            </a>
                        </div>

                        <!-- Top Pagination Nav -->
                        @if($bukus->hasPages())
                            <div class="flex items-center gap-1 bg-white border border-gray-100 rounded-[1.5rem] p-1">
                                <a href="{{ $bukus->previousPageUrl() }}" class="p-2 hover:bg-indigo-50 rounded-full text-gray-400 hover:text-indigo-600 transition-colors {{ $bukus->onFirstPage() ? 'opacity-20 pointer-events-none' : '' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </a>
                                <span class="text-xs font-bold text-gray-600 px-2 min-w-[50px] text-center">{{ $bukus->currentPage() }} / {{ $bukus->lastPage() }}</span>
                                <a href="{{ $bukus->nextPageUrl() }}" class="p-2 hover:bg-indigo-50 rounded-full text-gray-400 hover:text-indigo-600 transition-colors {{ !$bukus->hasMorePages() ? 'opacity-20 pointer-events-none' : '' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            @if($viewMode === 'table')
                <!-- TABLE VIEW (10 Items) -->
                <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center w-16">#</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Informasi Buku</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                                <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Stok</th>
                                <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Aksi</th>
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
                                                <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $buku->judul }}</p>
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
                                        <span class="text-sm font-bold {{ $buku->stok > 0 ? 'text-gray-700' : 'text-rose-500' }}">{{ $buku->stok }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.buku.show', $buku) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Detail Buku">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('admin.buku.edit', $buku) }}" class="p-2 text-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.buku.destroy', $buku) }}" method="POST" class="inline" onsubmit="return confirm('Hapus buku?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
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
                <!-- CARD VIEW (4 Items) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($bukus as $buku)
                        <div class="group bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-500 flex flex-col">
                            <!-- Book Cover (Compact) -->
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
                                <div class="absolute top-3 left-3">
                                    <span class="px-3 py-1 bg-white/80 backdrop-blur-md rounded-full text-[9px] font-bold text-indigo-600 shadow-sm border border-indigo-50 uppercase tracking-wider">
                                        {{ $buku->genre->nama_genre }}
                                    </span>
                                </div>

                                <!-- Stock Indicator -->
                                <div class="absolute bottom-3 right-3">
                                    <span class="px-2 py-1 {{ $buku->stok > 0 ? 'bg-emerald-500' : 'bg-rose-500' }} rounded-lg text-white text-[10px] font-bold shadow-lg shadow-indigo-100/10">
                                        {{ $buku->stok }} Stok
                                    </span>
                                </div>
                            </div>

                            <!-- Book Content -->
                            <div class="p-4 flex flex-col flex-1 bg-white">
                                <h3 class="text-sm font-bold text-gray-900 leading-tight mb-3 line-clamp-2 h-10 group-hover:text-indigo-600 transition-colors" title="{{ $buku->judul }}">
                                    {{ $buku->judul }}
                                </h3>
                                
                                <div class="space-y-1.5 mb-4">
                                    <p class="text-[11px] text-gray-500 flex items-center">
                                        <span class="w-1 h-1 bg-indigo-400 rounded-full mr-2"></span>
                                        <span class="truncate">{{ $buku->penulis ?? 'Anonim' }}</span>
                                    </p>
                                    @if($buku->isbn)
                                        <p class="text-[10px] font-mono text-indigo-500 bg-indigo-50/50 px-2 py-1 rounded-md inline-block">
                                            {{ $buku->isbn }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col gap-2 mt-auto">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.buku.show', $buku) }}" 
                                           class="flex-1 inline-flex items-center justify-center py-2 bg-gray-50 text-gray-600 text-[11px] font-bold rounded-xl hover:bg-gray-200 transition-all">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.buku.edit', $buku) }}" 
                                           class="flex-1 inline-flex items-center justify-center py-2 bg-indigo-50 text-indigo-600 text-[11px] font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition-all">
                                            Edit
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.buku.destroy', $buku) }}" method="POST" class="w-full" onsubmit="return confirm('Hapus buku?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex items-center justify-center py-2 bg-rose-50 text-rose-500 text-[11px] font-bold rounded-xl hover:bg-rose-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus Buku
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <p class="text-gray-400 font-medium">Buku tidak ditemukan</p>
                        </div>
                    @endforelse
                </div>
            @endif

            <!-- Bottom Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $bukus->links() }}
            </div>
        </div>
    </div>
</x-app-layout>