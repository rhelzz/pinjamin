<x-app-layout>
    <x-slot name="pageTitle">Edit Profile</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">Profile Saya</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola informasi akun dan keamanan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-0 pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header Card -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-2xl shadow-xl mb-6 overflow-hidden">
                <div class="px-6 py-8 sm:px-8 sm:py-10">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <!-- Avatar -->
                        <div class="relative">
                            <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-white/30">
                                <span class="text-4xl font-bold text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 rounded-full border-2 border-white"></div>
                        </div>
                        <!-- User Info -->
                        <div class="text-center sm:text-left">
                            <h3 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h3>
                            <p class="text-indigo-100 mt-1">{{ Auth::user()->email }}</p>
                            <div class="mt-3 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    {{ Auth::user()->role->nama_role ?? 'User' }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/30 text-white backdrop-blur-sm">
                                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5 animate-pulse"></span>
                                    {{ ucfirst(Auth::user()->status) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-white/80 backdrop-blur-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Bergabung {{ Auth::user()->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Sections -->
            <div class="grid gap-6">
                <!-- Update Profile Information -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Profile</h3>
                                <p class="text-sm text-gray-500">Perbarui informasi akun dan alamat email Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                                <p class="text-sm text-gray-500">Pastikan akun Anda menggunakan password yang kuat</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="bg-white border border-red-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-red-200 bg-gradient-to-r from-red-50 to-white px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-red-500 to-rose-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-red-900">Hapus Akun</h3>
                                <p class="text-sm text-red-600">Hapus akun dan semua data Anda secara permanen</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
