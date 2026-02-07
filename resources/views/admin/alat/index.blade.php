<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Data Alat</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola inventaris alat sekolah</p>
            </div>
            <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Alat
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Main Content Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                
                <!-- Filter & Search Header -->
                <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 p-6">
                    <form method="GET" class="flex flex-col md:flex-row gap-3">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari nama alat atau deskripsi..." 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="relative w-full md:w-64">
                            <select name="kategori_id" 
                                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">📁 Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter
                        </button>
                        
                        @if(request('search') || request('kategori_id'))
                            <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.alat.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        #
                                        @if(request('sort_by') == 'id')
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.alat.index', array_merge(request()->all(), ['sort_by' => 'nama_alat', 'sort_direction' => request('sort_by') == 'nama_alat' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        Alat
                                        @if(request('sort_by') == 'nama_alat')
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
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.alat.index', array_merge(request()->all(), ['sort_by' => 'stok', 'sort_direction' => request('sort_by') == 'stok' && request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center hover:text-indigo-600 transition-colors">
                                        Stok
                                        @if(request('sort_by') == 'stok')
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
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($alats as $alat)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $alat->stok == 0 ? 'bg-red-50/30' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-xs font-bold text-gray-600">
                                            {{ $loop->iteration + ($alats->currentPage() - 1) * $alats->perPage() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-4">
                                            <!-- Image -->
                                            <div class="flex-shrink-0">
                                                @if($alat->gambar)
                                                    <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" 
                                                        class="w-16 h-16 object-cover rounded-lg shadow-md ring-2 ring-gray-200">
                                                @else
                                                    <div class="w-16 h-16 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg shadow-md flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- Info -->
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $alat->nama_alat }}</p>
                                                @if($alat->deskripsi)
                                                    <p class="text-xs text-gray-500 line-clamp-2 mt-1">
                                                        {{ Str::limit($alat->deskripsi, 60) }}
                                                    </p>
                                                @else
                                                    <p class="text-xs text-gray-400 italic mt-1">Tidak ada deskripsi</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 ring-1 ring-amber-200">
                                            {{ $alat->kategori->nama_kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($alat->stok > 3)
                                            <div class="inline-flex flex-col items-center">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-green-100 text-green-800 ring-1 ring-green-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $alat->stok }}
                                                </span>
                                                <span class="text-xs text-green-600 font-medium mt-1">Tersedia</span>
                                            </div>
                                        @elseif($alat->stok > 0)
                                            <div class="inline-flex flex-col items-center">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $alat->stok }}
                                                </span>
                                                <span class="text-xs text-yellow-600 font-medium mt-1">Stok Rendah</span>
                                            </div>
                                        @else
                                            <div class="inline-flex flex-col items-center">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-red-100 text-red-800 ring-1 ring-red-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    0
                                                </span>
                                                <span class="text-xs text-red-600 font-medium mt-1">Habis</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.alat.edit', $alat) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-white hover:bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.alat.destroy', $alat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus alat ini? Data peminjaman terkait akan terpengaruh.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white hover:bg-red-50 border border-red-200 text-red-700 text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 mb-2">
                                                @if(request('search') || request('kategori_id'))
                                                    Tidak Ada Hasil
                                                @else
                                                    Belum Ada Alat
                                                @endif
                                            </h3>
                                            <p class="text-sm text-gray-500 mb-6 max-w-sm">
                                                @if(request('search'))
                                                    Tidak ditemukan alat dengan kata kunci "{{ request('search') }}". Coba kata kunci lain.
                                                @elseif(request('kategori_id'))
                                                    Tidak ada alat dalam kategori yang dipilih.
                                                @else
                                                    Mulai dengan menambahkan alat pertama ke inventaris sekolah.
                                                @endif
                                            </p>
                                            @if(request('search') || request('kategori_id'))
                                                <a href="{{ route('admin.alat.index') }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Reset Filter
                                                </a>
                                            @else
                                                <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    Tambah Alat Pertama
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($alats->hasPages())
                    <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                        {{ $alats->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
