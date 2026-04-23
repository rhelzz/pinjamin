<x-app-layout>
    <x-slot name="pageTitle">Edit Buku</x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Edit Buku</h2>
                <p class="mt-1 text-sm text-gray-600">Perbarui informasi untuk: <span class="font-semibold text-gray-900">{{ $buku->judul }}</span></p>
            </div>
            <a href="{{ route('admin.buku.index') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
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
                        <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg shadow-md flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Buku</h3>
                            <p class="mt-1 text-sm text-gray-600">Perbarui data yang diperlukan</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.buku.update', $buku) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info Section -->
                    <div class="space-y-5">
                        <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Informasi Dasar</h4>
                        </div>

                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Buku <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('judul') border-red-500 @enderror" 
                                    placeholder="Nama buku" 
                                    required>
                            </div>
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">Penulis</label>
                                <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}" class="block w-full px-3 py-3 border border-gray-300 rounded-lg @error('penulis') border-red-500 @enderror" placeholder="Nama penulis">
                                @error('penulis')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-2">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="block w-full px-3 py-3 border border-gray-300 rounded-lg @error('penerbit') border-red-500 @enderror" placeholder="Nama penerbit">
                                @error('penerbit')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="block w-full px-3 py-3 border border-gray-300 rounded-lg @error('tahun_terbit') border-red-500 @enderror" placeholder="Contoh: 2024" min="1900" max="2100">
                                @error('tahun_terbit')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="isbn" class="block text-sm font-semibold text-gray-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $buku->isbn) }}" class="block w-full px-3 py-3 border border-gray-300 rounded-lg @error('isbn') border-red-500 @enderror" placeholder="Nomor ISBN">
                                @error('isbn')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="genre_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Genre <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="genre_id" id="genre_id" 
                                        class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all appearance-none bg-white @error('genre_id') border-red-500 @enderror" 
                                        required>
                                        <option value="">Pilih Genre</option>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" {{ old('genre_id', $buku->genre_id) == $genre->id ? 'selected' : '' }}>
                                                {{ $genre->nama_genre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('genre_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Jumlah Stok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                    </div>
                                    <input type="number" name="stok" id="stok" value="{{ old('stok', $buku->stok) }}" min="0" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('stok') border-red-500 @enderror" 
                                        required>
                                </div>
                                @error('stok')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('deskripsi') border-red-500 @enderror" 
                                placeholder="Deskripsi lengkap tentang buku">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Section -->
                    <div class="space-y-5">
                        <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Gambar Buku</h4>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Gambar Buku</label>
                            <div id="dropzone" class="relative group cursor-pointer border-2 border-dashed border-gray-200 rounded-[2.5rem] overflow-hidden hover:border-indigo-400 hover:bg-indigo-50/30 transition-all p-8 min-h-[350px] flex items-center justify-center">
                                <!-- Upload Placeholder (Only shown when no image at all) -->
                                <div id="upload-placeholder" class="{{ $buku->gambar ? 'hidden' : '' }} text-center space-y-3 transition-all duration-500 group-hover:scale-105">
                                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="h-8 w-8 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-600">Klik atau seret gambar ke sini</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">PNG, JPG up to 2MB</p>
                                </div>

                                <!-- Current Image or New Preview -->
                                <div id="preview-container" class="{{ $buku->gambar ? '' : 'hidden' }} relative h-[300px] aspect-[3/4] transition-all duration-500">
                                    <img id="image-preview" src="{{ $buku->gambar ? asset('storage/' . $buku->gambar) : '#' }}" 
                                        class="h-full w-full object-cover rounded-2xl shadow-2xl shadow-indigo-200 ring-4 ring-white transition-all duration-500">
                                    
                                    <!-- Hover Overlay with Glassmorphism -->
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-2xl flex flex-col items-center justify-center backdrop-blur-[2px]">
                                        <div class="bg-white/20 backdrop-blur-md border border-white/30 px-5 py-2.5 rounded-full text-white text-xs font-bold uppercase tracking-widest shadow-2xl mb-2 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                            Ganti Gambar
                                        </div>
                                        <p class="text-[10px] text-white/80 font-medium">Klik di mana saja untuk mengubah</p>
                                    </div>

                                    <!-- Remove/Reset Button -->
                                    <button type="button" id="remove-preview" class="hidden absolute -top-3 -right-3 bg-rose-500 text-white p-2 rounded-full shadow-xl hover:bg-rose-600 transition-all transform hover:scale-110 active:scale-95 z-10">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>

                                <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only">
                            </div>
                            <div class="mt-4 flex items-center justify-between px-2">
                                <p class="text-[11px] text-indigo-500 font-bold uppercase tracking-tight italic">
                                    * Format 3:4 direkomendasikan untuk tampilan terbaik
                                </p>
                                @if($buku->gambar)
                                    <span class="text-[10px] bg-emerald-50 text-emerald-600 px-2 py-1 rounded-md font-bold border border-emerald-100 uppercase">Gambar Tersimpan</span>
                                @endif
                            </div>
                            @error('gambar')
                                <p class="mt-2 text-sm text-rose-500 font-bold px-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const dropzone = document.getElementById('dropzone');
                                const input = document.getElementById('gambar');
                                const placeholder = document.getElementById('upload-placeholder');
                                const previewContainer = document.getElementById('preview-container');
                                const previewImg = document.getElementById('image-preview');
                                const removeBtn = document.getElementById('remove-preview');

                                dropzone.addEventListener('click', () => input.click());

                                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                                    dropzone.addEventListener(eventName, e => {
                                        e.preventDefault();
                                        e.stopPropagation();
                                    }, false);
                                });

                                ['dragenter', 'dragover'].forEach(eventName => {
                                    dropzone.addEventListener(eventName, () => dropzone.classList.add('bg-indigo-50', 'border-indigo-400'));
                                });

                                ['dragleave', 'drop'].forEach(eventName => {
                                    dropzone.addEventListener(eventName, () => dropzone.classList.remove('bg-indigo-50', 'border-indigo-400'));
                                });

                                dropzone.addEventListener('drop', e => {
                                    const dt = e.dataTransfer;
                                    input.files = dt.files;
                                    handleFiles(dt.files[0]);
                                });

                                input.addEventListener('change', function() {
                                    if (this.files && this.files[0]) handleFiles(this.files[0]);
                                });

                                function handleFiles(file) {
                                    if (file && file.type.startsWith('image/')) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            previewImg.src = e.target.result;
                                            placeholder.classList.add('hidden');
                                            previewContainer.classList.remove('hidden');
                                            removeBtn.classList.remove('hidden');
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                }

                                removeBtn.addEventListener('click', (e) => {
                                    e.stopPropagation();
                                    input.value = '';
                                    @if($buku->gambar)
                                        previewImg.src = "{{ asset('storage/' . $buku->gambar) }}";
                                        removeBtn.classList.add('hidden');
                                    @else
                                        previewContainer.classList.add('hidden');
                                        placeholder.classList.remove('hidden');
                                    @endif
                                });
                            });
                        </script>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.buku.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Perbarui Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
