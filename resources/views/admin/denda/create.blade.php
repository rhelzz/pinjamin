<x-app-layout>
    <x-slot name="pageTitle">Tambah Tarif Denda</x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Tambah Denda</h2>
                <p class="mt-1 text-sm text-gray-600">Buat tarif denda baru untuk keterlambatan atau kerusakan</p>
            </div>
            <a href="{{ route('admin.denda.index') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm transition-all duration-200">
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
                
                <div class="bg-gradient-to-r from-red-50 to-white border-b border-gray-200 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-red-400 to-rose-500 rounded-lg shadow-md flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Denda</h3>
                            <p class="mt-1 text-sm text-gray-600">Tentukan tarif denda yang akan dikenakan</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.denda.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf

                    <div>
                        <label for="nama_denda" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Denda <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_denda" id="nama_denda" value="{{ old('nama_denda') }}" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('nama_denda') border-red-500 @enderror" 
                            placeholder="Contoh: Denda Keterlambatan, Denda Kerusakan Ringan" 
                            required>
                        @error('nama_denda')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tipe Denda <span class="text-red-500">*</span>
                        </label>
                        <select name="tipe" id="tipe" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('tipe') border-red-500 @enderror" 
                            required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="per_jam" {{ old('tipe') === 'per_jam' ? 'selected' : '' }}>Per Jam (untuk keterlambatan)</option>
                            <option value="per_hari" {{ old('tipe') === 'per_hari' ? 'selected' : '' }}>Per Hari (untuk keterlambatan)</option>
                            <option value="tetap" {{ old('tipe') === 'tetap' ? 'selected' : '' }}>Tetap (untuk kerusakan)</option>
                        </select>
                        @error('tipe')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">
                            <strong>Per Jam:</strong> Nominal × jumlah jam keterlambatan. <strong>Per Hari:</strong> Nominal × jumlah hari. <strong>Tetap:</strong> Nominal tetap untuk kerusakan.
                        </p>
                    </div>

                    <div>
                        <label for="nominal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nominal (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}" 
                                class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('nominal') border-red-500 @enderror" 
                                placeholder="10000" 
                                min="0" step="1000"
                                required>
                        </div>
                        @error('nominal')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('deskripsi') border-red-500 @enderror" 
                            placeholder="Deskripsi tambahan tentang denda ini (opsional)">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <label for="aktif" class="ml-3 text-sm font-medium text-gray-700">
                            Aktifkan denda ini
                        </label>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-blue-800 mb-2">Contoh Perhitungan</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li><strong>Per Hari:</strong> Jika nominal Rp 5.000 dan terlambat 3 hari = Rp 15.000</li>
                                    <li><strong>Tetap:</strong> Jika nominal Rp 50.000 untuk kerusakan = Rp 50.000 (tidak dikalikan)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.denda.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium shadow-sm hover:shadow-md transition-all">
                            Simpan Denda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
