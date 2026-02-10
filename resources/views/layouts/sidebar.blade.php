<aside x-data="{ open: true }" class="fixed top-0 left-0 h-screen bg-gradient-to-b from-white to-gray-50 text-gray-700 w-64 flex-shrink-0 flex flex-col shadow-2xl border-r border-gray-200 z-40">
    <!-- Logo / Brand -->
    <div class="flex items-center justify-between h-16 px-4 bg-gray-100/80 backdrop-blur-sm border-b border-gray-200">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5 group">
            <div class="p-1.5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <span class="text-gray-900 font-bold text-lg tracking-tight">Pinjamin</span>
        </a>
    </div>

    <!-- Navigation Links with Custom Scrollbar -->
    <nav class="flex-1 px-2.5 py-3 space-y-0.5 overflow-y-auto scrollbar-custom">
        <!-- Dashboard -->
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
        @elseif(Auth::user()->isPetugas())
            <a href="{{ route('petugas.dashboard') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('petugas.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('petugas.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
        @else
            <a href="{{ route('peminjam.dashboard') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peminjam.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
        @endif

        {{-- ==================== ADMIN MENU ==================== --}}
        @if(Auth::user()->isAdmin())
            <div class="pt-5 pb-2">
                <div class="flex items-center px-3">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <p class="px-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Admin</p>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            <a href="{{ route('admin.kategori.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.kategori.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.kategori.*') ? 'text-white' : 'text-gray-500 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.alat.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.alat.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.alat.*') ? 'text-white' : 'text-gray-500 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                <span>Data Alat</span>
            </a>

            <a href="{{ route('admin.user.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.user.index') || request()->routeIs('admin.user.create') || request()->routeIs('admin.user.edit') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.user.index') || request()->routeIs('admin.user.create') || request()->routeIs('admin.user.edit') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Manajemen User</span>
            </a>

            @php
                $pendingUsersCount = \App\Models\User::where('status', 'pending')->count();
            @endphp
            <a href="{{ route('admin.user.pending') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.user.pending') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.user.pending') ? 'text-white' : 'text-gray-500 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    <span>Persetujuan User</span>
                </div>
                @if($pendingUsersCount > 0)
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold {{ request()->routeIs('admin.user.pending') ? 'bg-white text-amber-600' : 'bg-amber-500 text-white' }} rounded-full">
                        {{ $pendingUsersCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.log.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.log.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.log.*') ? 'text-white' : 'text-gray-500 group-hover:text-purple-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Log Aktivitas</span>
            </a>

            <a href="{{ route('admin.denda.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.denda.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.denda.*') ? 'text-white' : 'text-gray-500 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Tarif Denda</span>
            </a>
        @endif

        {{-- ==================== PETUGAS MENU ==================== --}}
        @if(Auth::user()->isAdmin() || Auth::user()->isPetugas())
            <div class="pt-5 pb-2">
                <div class="flex items-center px-3">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <p class="px-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Petugas</p>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            <a href="{{ route('petugas.approval.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('petugas.approval.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('petugas.approval.*') ? 'text-white' : 'text-gray-500 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Persetujuan</span>
            </a>

            <a href="{{ route('petugas.pengembalian.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('petugas.pengembalian.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('petugas.pengembalian.*') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                <span>Pengembalian</span>
            </a>

            <a href="{{ route('petugas.laporan.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('petugas.laporan.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('petugas.laporan.*') ? 'text-white' : 'text-gray-500 group-hover:text-orange-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Laporan</span>
            </a>

            <a href="{{ route('petugas.history.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('petugas.history.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('petugas.history.*') ? 'text-white' : 'text-gray-500 group-hover:text-purple-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>History Peminjaman</span>
            </a>
        @endif

        {{-- ==================== PEMINJAM MENU ==================== --}}
        <div class="pt-5 pb-2">
            <div class="flex items-center px-3">
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                <p class="px-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Peminjaman</p>
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            </div>
        </div>

        <a href="{{ route('peminjam.katalog.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peminjam.katalog.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.katalog.*') ? 'text-white' : 'text-gray-500 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span>Katalog Alat</span>
        </a>

        <a href="{{ route('peminjam.cart.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peminjam.cart.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.cart.*') ? 'text-white' : 'text-gray-500 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            <span class="flex-1">Keranjang</span>
            @php $cartCount = count(session('cart', [])); @endphp
            @if($cartCount > 0)
                <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full shadow-lg shadow-indigo-500/50 animate-pulse">{{ $cartCount }}</span>
            @endif
        </a>

        <a href="{{ route('peminjam.peminjaman.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peminjam.peminjaman.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.peminjaman.*') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Riwayat Peminjaman</span>
        </a>

        <a href="{{ route('peminjam.booking.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peminjam.booking.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.booking.*') ? 'text-white' : 'text-gray-500 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span>Booking</span>
        </a>

        {{-- ==================== NOTIFIKASI ==================== --}}
        <div class="pt-5 pb-2">
            <div class="flex items-center px-3">
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                <p class="px-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Lainnya</p>
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            </div>
        </div>

        <a href="{{ route('notifikasi.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('notifikasi.*') ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white scale-[1.02]' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:translate-x-1' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('notifikasi.*') ? 'text-white' : 'text-gray-500 group-hover:text-yellow-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="flex-1">Notifikasi</span>
            @if(isset($unreadNotifikasiCount) && $unreadNotifikasiCount > 0)
                <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-full shadow-lg shadow-red-500/50 animate-pulse">{{ $unreadNotifikasiCount }}</span>
            @endif
        </a>
    </nav>

    <!-- User Info at Bottom -->
    <div class="border-t border-gray-200 bg-gray-50 p-4 backdrop-blur-sm">
        <div class="flex items-center group">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300 ring-2 ring-gray-300 group-hover:ring-indigo-500/50">
                    <span class="text-sm font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-indigo-600 transition-colors">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-600 truncate flex items-center">
                    <span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                    {{ Auth::user()->role->nama_role ?? '-' }}
                </p>
            </div>
        </div>
    </div>
</aside>

<style>
/* Custom Scrollbar Styling */
.scrollbar-custom {
    scrollbar-width: thin;
    scrollbar-color: #9CA3AF #F3F4F6;
}

.scrollbar-custom::-webkit-scrollbar {
    width: 6px;
}

.scrollbar-custom::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #F9FAFB, #F3F4F6);
    border-radius: 10px;
}

.scrollbar-custom::-webkit-scrollbar-thumb {
    background: #9CA3AF;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.scrollbar-custom::-webkit-scrollbar-thumb:hover {
    background: #6B7280;
}
</style>
