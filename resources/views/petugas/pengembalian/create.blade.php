<x-app-layout>
    <x-slot name="pageTitle">Proses Pengembalian</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proses Pengembalian #{{ $peminjaman->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Peminjaman -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Peminjaman</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Peminjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                            <p class="font-medium text-gray-900">{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Rencana Kembali</p>
                            <p class="font-medium {{ $peminjaman->tanggal_kembali->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $peminjaman->tanggal_kembali->format('d M Y H:i') }}
                                @if($peminjaman->tanggal_kembali->isPast())
                                    (Terlambat {{ $jamTerlambat }} jam)
                                @endif
                            </p>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjaman->detail as $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Pengembalian -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Pengembalian</h3>
                    <form action="{{ route('petugas.pengembalian.store', $peminjaman) }}" method="POST"
                        data-confirm="Proses pengembalian alat ini?"
                        data-confirm-title="Konfirmasi Pengembalian"
                        data-confirm-type="info">
                        @csrf

                        <div class="mb-4">
                            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Alat</label>
                            <select name="kondisi" id="kondisi" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik" {{ old('kondisi') === 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ old('kondisi') === 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('kondisi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Denda Section -->
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Denda</h4>
                            
                            @if($jamTerlambat > 0)
                                <div class="mb-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800">
                                        <strong>Perhatian:</strong> Peminjaman ini terlambat <strong>{{ $jamTerlambat }} jam</strong>.
                                    </p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="denda_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Jenis Denda</label>
                                <select name="denda_id" id="denda_id"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    onchange="hitungDenda()">
                                    <option value="">-- Tidak Ada Denda --</option>
                                    @foreach($dendas as $d)
                                        <option value="{{ $d->id }}" 
                                            data-tipe="{{ $d->tipe }}" 
                                            data-nominal="{{ $d->nominal }}"
                                            {{ old('denda_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->nama_denda }} - Rp {{ number_format($d->nominal, 0, ',', '.') }}
                                            @if($d->tipe === 'per_jam') /jam @elseif($d->tipe === 'per_hari') /hari @endif
                                        </option>
                                    @endforeach
                                    <option value="custom" {{ old('denda_id') === 'custom' ? 'selected' : '' }}>-- Denda Custom --</option>
                                </select>
                            </div>

                            @if($jamTerlambat > 0)
                                <div id="jam-terlambat-info" class="mb-3 hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam Terlambat</label>
                                    <input type="number" id="jam_terlambat" name="jam_terlambat" value="{{ $jamTerlambat }}" min="0"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        onchange="hitungDenda()">
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="denda" class="block text-sm font-medium text-gray-700 mb-1">Total Denda (Rp)</label>
                                <input type="number" name="denda" id="denda" value="{{ old('denda', 0) }}" min="0" step="1000"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('denda')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <p id="denda-kalkulasi" class="text-xs text-gray-500 hidden"></p>
                        </div>

                        <div class="mb-6">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" placeholder="Catatan tambahan (opsional)..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center space-x-3">
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium">
                                Proses Pengembalian
                            </button>
                            <a href="{{ route('petugas.pengembalian.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const jamTerlambat = Math.max(0, Math.ceil({{ $jamTerlambat }}));

        function hitungDenda() {
            const select = document.getElementById('denda_id');
            const dendaInput = document.getElementById('denda');
            const kalkulasiText = document.getElementById('denda-kalkulasi');
            const jamInfo = document.getElementById('jam-terlambat-info');
            
            if (select.value === '' || select.value === 'custom') {
                if (jamInfo) jamInfo.classList.add('hidden');
                kalkulasiText.classList.add('hidden');
                if (select.value === '') {
                    dendaInput.value = 0;
                }
                dendaInput.readOnly = false;
                return;
            }

            const option = select.options[select.selectedIndex];
            const tipe = option.dataset.tipe;
            const nominal = parseFloat(option.dataset.nominal);

            if (tipe === 'per_jam') {
                if (jamInfo) jamInfo.classList.remove('hidden');
                const inputJam = document.getElementById('jam_terlambat');
                const jam = Math.max(0, inputJam ? parseInt(inputJam.value) || 0 : jamTerlambat);
                const total = Math.max(0, nominal * jam);
                dendaInput.value = total;
                kalkulasiText.textContent = `Kalkulasi: Rp ${numberFormat(nominal)} x ${jam} jam = Rp ${numberFormat(total)}`;
                kalkulasiText.classList.remove('hidden');
            } else if (tipe === 'per_hari') {
                if (jamInfo) jamInfo.classList.remove('hidden');
                const inputJam = document.getElementById('jam_terlambat');
                const jam = Math.max(0, inputJam ? parseInt(inputJam.value) || 0 : jamTerlambat);
                const hari = Math.ceil(jam / 24);
                const total = Math.max(0, nominal * hari);
                dendaInput.value = total;
                kalkulasiText.textContent = `Kalkulasi: Rp ${numberFormat(nominal)} x ${hari} hari (${jam} jam) = Rp ${numberFormat(total)}`;
                kalkulasiText.classList.remove('hidden');
            } else {
                if (jamInfo) jamInfo.classList.add('hidden');
                dendaInput.value = Math.max(0, nominal);
                kalkulasiText.textContent = `Denda tetap: Rp ${numberFormat(nominal)}`;
                kalkulasiText.classList.remove('hidden');
            }
            
            dendaInput.readOnly = true;
        }

        function numberFormat(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            hitungDenda();
        });
    </script>
</x-app-layout>
