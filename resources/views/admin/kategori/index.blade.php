<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Data Kategori Alat</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola kategori untuk klasifikasi alat</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Main Content Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                
                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <a href="{{ route('admin.kategori.index', ['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center hover:text-indigo-600 transition-colors">
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
                                    <a href="{{ route('admin.kategori.index', ['sort_by' => 'nama_kategori', 'sort_direction' => request('sort_by') == 'nama_kategori' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center hover:text-indigo-600 transition-colors">
                                        Kategori
                                        @if(request('sort_by') == 'nama_kategori')
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
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Jumlah Alat</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kategoris as $kategori)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 text-xs font-bold text-gray-600">
                                            {{ $loop->iteration + ($kategoris->currentPage() - 1) * $kategoris->perPage() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg shadow-md flex items-center justify-center">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $kategori->nama_kategori }}</div>
                                                <div class="text-xs text-gray-500">Kategori #{{ $loop->iteration + ($kategoris->currentPage() - 1) * $kategoris->perPage() }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="inline-flex items-center">
                                            @if($kategori->alat_count > 0)
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                                    </svg>
                                                    {{ $kategori->alat_count }} Alat
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gray-100 text-gray-600 ring-1 ring-gray-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Kosong
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.kategori.edit', $kategori) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-white hover:bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Alat dalam kategori ini akan kehilangan kategorinya.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white hover:bg-red-50 border border-red-200 text-red-700 text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-100 rounded-full mb-4">
                                                <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 mb-2">Belum Ada Kategori</h3>
                                            <p class="text-sm text-gray-500 mb-6 max-w-sm">Mulai dengan membuat kategori pertama untuk mengklasifikasikan alat-alat sekolah</p>
                                            <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Kategori Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($kategoris->hasPages())
                    <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                        {{ $kategoris->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
