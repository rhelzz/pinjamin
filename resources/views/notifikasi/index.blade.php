<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notifikasi</h2>
            @if(isset($unreadNotifikasiCount) && $unreadNotifikasiCount > 0)
                <form action="{{ route('notifikasi.readAll') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-800">Tandai semua dibaca</button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-3">
                @forelse($notifikasis as $notifikasi)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg {{ !$notifikasi->is_read ? 'border-l-4 border-indigo-500' : '' }}">
                        <div class="p-4 flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm {{ !$notifikasi->is_read ? 'font-semibold text-gray-900' : 'text-gray-600' }}">
                                    {{ $notifikasi->pesan }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notifikasi->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notifikasi->is_read)
                                <form action="{{ route('notifikasi.read', $notifikasi->id) }}" method="POST" class="ml-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-800 whitespace-nowrap">Tandai dibaca</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-500">Belum ada notifikasi.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $notifikasis->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
