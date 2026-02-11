<x-app-layout>
    <x-slot name="pageTitle">Buat Booking</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Booking: {{ $alat->nama_alat }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Alat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-20 w-20 bg-gray-200 rounded-lg flex items-center justify-center">
                            @if($alat->gambar)
                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $alat->nama_alat }}</h3>
                            <p class="text-sm text-indigo-600">{{ $alat->kategori->nama_kategori }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $alat->deskripsi ?? '-' }}</p>
                            <p class="mt-2">
                                <span class="text-sm font-medium {{ $alat->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    Stok saat ini: {{ $alat->stok }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if($activePeminjamans->count() > 0)
                <!-- Info Peminjaman Aktif -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-blue-800 mb-3">Peminjaman Aktif untuk Alat Ini</h4>
                    <div class="space-y-2">
                        @foreach($activePeminjamans as $peminjaman)
                            <div class="flex items-center justify-between bg-white rounded-lg p-3 border border-blue-100">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $peminjaman->user->name }}</p>
                                    <p class="text-xs text-gray-500">Dipinjam sejak {{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-blue-600">Kembali: {{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
                                    @if($peminjaman->tanggal_kembali->isPast())
                                        <span class="text-xs text-red-600">(Terlambat)</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form Booking -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Booking</h3>
                        <form action="{{ route('peminjam.booking.store', $alat) }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">
                                        Jumlah yang Diinginkan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('jumlah')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="referensi_peminjaman_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Referensi Peminjaman (Opsional)
                                    </label>
                                    <select name="referensi_peminjaman_id" id="referensi_peminjaman_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Pilih untuk menunggu pengembalian tertentu --</option>
                                        @foreach($activePeminjamans as $peminjaman)
                                            <option value="{{ $peminjaman->id }}" {{ old('referensi_peminjaman_id') == $peminjaman->id ? 'selected' : '' }}>
                                                {{ $peminjaman->user->name }} - Kembali {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('referensi_peminjaman_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_booking" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tanggal Ingin Meminjam <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_booking" id="tanggal_booking" 
                                        value="{{ old('tanggal_booking', $earliestReturn?->tanggal_kembali->addDay()->format('Y-m-d')) }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('tanggal_booking')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    @if($earliestReturn)
                                        <p class="mt-1 text-xs text-gray-500">
                                            Rekomendasi: setelah {{ $earliestReturn->tanggal_kembali->format('d M Y') }} (tanggal kembali tercepat)
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">
                                        Rencana Tanggal Kembali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" 
                                        value="{{ old('tanggal_kembali') }}"
                                        min="{{ old('tanggal_booking', $earliestReturn?->tanggal_kembali->addDay()->format('Y-m-d') ?? now()->addDay()->format('Y-m-d')) }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('tanggal_kembali')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">
                                        Harus lebih dari tanggal ingin meminjam
                                    </p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Catatan (Opsional)
                                </label>
                                <textarea name="catatan" id="catatan" rows="3" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Catatan tambahan untuk booking ini...">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-yellow-800">Informasi Booking</p>
                                        <ul class="text-sm text-yellow-700 mt-1 list-disc list-inside space-y-1">
                                            <li>Booking tidak menjamin ketersediaan alat</li>
                                            <li>Anda akan diberitahu saat alat tersedia</li>
                                            <li>Untuk memastikan dapat meminjam, segera ajukan peminjaman setelah menerima notifikasi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Ajukan Booking
                                </button>
                                <a href="{{ route('peminjam.katalog.show', $alat) }}" class="text-gray-600 hover:text-gray-800 text-sm">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <svg class="w-12 h-12 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h4 class="font-semibold text-green-800 mb-2">Alat Tersedia!</h4>
                    <p class="text-green-700 mb-4">Tidak ada peminjaman aktif untuk alat ini. Anda dapat langsung meminjam!</p>
                    <a href="{{ route('peminjam.katalog.show', $alat) }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        Langsung Pinjam
                    </a>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('peminjam.katalog.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Kembali ke Katalog</a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalBooking = document.getElementById('tanggal_booking');
            const tanggalKembali = document.getElementById('tanggal_kembali');

            // Update min tanggal kembali saat tanggal booking berubah
            tanggalBooking.addEventListener('change', function() {
                if (this.value) {
                    // Set min tanggal kembali = tanggal booking + 1 hari
                    const bookingDate = new Date(this.value);
                    bookingDate.setDate(bookingDate.getDate() + 1);
                    
                    const minReturnDate = bookingDate.toISOString().split('T')[0];
                    tanggalKembali.min = minReturnDate;
                    
                    // Reset nilai tanggal kembali jika kurang dari min baru
                    if (tanggalKembali.value && tanggalKembali.value < minReturnDate) {
                        tanggalKembali.value = minReturnDate;
                    }
                    
                    // Set value default jika belum diisi
                    if (!tanggalKembali.value) {
                        tanggalKembali.value = minReturnDate;
                    }
                }
            });

            // Trigger sekali saat page load jika tanggal booking sudah ada value
            if (tanggalBooking.value) {
                tanggalBooking.dispatchEvent(new Event('change'));
            }
        });
    </script>
    @endpush
</x-app-layout>
