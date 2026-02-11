<x-app-layout>
    <x-slot name="pageTitle">Edit Tarif Denda</x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Edit Denda</h2>
                <p class="mt-1 text-sm text-gray-600">Ubah tarif denda: {{ $denda->nama_denda }}</p>
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
                            <h3 class="text-lg font-semibold text-gray-900">Edit Informasi Denda</h3>
                            <p class="mt-1 text-sm text-gray-600">Perbarui tarif denda yang dikenakan</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.denda.update', $denda) }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama_denda" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Denda <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_denda" id="nama_denda" value="{{ old('nama_denda', $denda->nama_denda) }}" 
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
                            <option value="per_jam" {{ old('tipe', $denda->tipe) === 'per_jam' ? 'selected' : '' }}>Per Jam (untuk keterlambatan)</option>
                            <option value="per_hari" {{ old('tipe', $denda->tipe) === 'per_hari' ? 'selected' : '' }}>Per Hari (untuk keterlambatan)</option>
                            <option value="tetap" {{ old('tipe', $denda->tipe) === 'tetap' ? 'selected' : '' }}>Tetap (untuk kerusakan)</option>
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
                            <input type="number" name="nominal" id="nominal" value="{{ old('nominal', $denda->nominal) }}" 
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
                            placeholder="Deskripsi tambahan tentang denda ini (opsional)">{{ old('deskripsi', $denda->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $denda->aktif) ? 'checked' : '' }}
                            class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <label for="aktif" class="ml-3 text-sm font-medium text-gray-700">
                            Aktifkan denda ini
                        </label>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.denda.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium shadow-sm hover:shadow-md transition-all">
                            Update Denda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
