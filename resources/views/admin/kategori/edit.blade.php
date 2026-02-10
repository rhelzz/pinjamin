<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Edit Kategori</h2>
                <p class="mt-1 text-sm text-gray-600">Perbarui informasi untuk: <span class="font-semibold text-gray-900">{{ $kategori->nama_kategori }}</span></p>
            </div>
            <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-indigo-50 to-white border-b border-gray-200 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg shadow-md flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Kategori</h3>
                            <p class="mt-1 text-sm text-gray-600">Perbarui nama kategori sesuai kebutuhan</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Category Name Field -->
                    <div class="space-y-5">
                        <div>
                            <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('nama_kategori') border-red-500 @enderror" 
                                    placeholder="Contoh: Alat Produktif" 
                                    required>
                            </div>
                            @error('nama_kategori')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <span>Perubahan nama kategori akan berlaku untuk semua alat yang menggunakan kategori ini.</span>
                            </p>
                        </div>
                    </div>

                    <!-- Category Stats Info Box -->
                    @if($kategori->alat_count > 0)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-semibold text-blue-900 mb-1">Kategori Ini Digunakan</h4>
                                    <p class="text-sm text-blue-800">
                                        Terdapat <span class="font-semibold">{{ $kategori->alat_count }} alat</span> yang menggunakan kategori ini.
                                        Perubahan nama akan mempengaruhi semua alat tersebut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-semibold text-amber-900 mb-1">Kategori Belum Digunakan</h4>
                                    <p class="text-sm text-amber-800">
                                        Belum ada alat yang menggunakan kategori ini. Anda dapat mengubah nama atau menghapusnya jika tidak diperlukan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
