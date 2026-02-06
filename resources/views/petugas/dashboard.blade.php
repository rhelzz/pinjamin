<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Petugas</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $pendingCount }}</p>
                        </div>
                    </div>
                    <a href="{{ route('petugas.approval.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-800">Proses sekarang &rarr;</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $dipinjamCount }}</p>
                        </div>
                    </div>
                    <a href="{{ route('petugas.pengembalian.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-800">Proses pengembalian &rarr;</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Selesai</p>
                            <p class="text-2xl font-bold text-green-600">{{ $selesaiCount }}</p>
                        </div>
                    </div>
                    <a href="{{ route('petugas.laporan.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-800">Lihat laporan &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
