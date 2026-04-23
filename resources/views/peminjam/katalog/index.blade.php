<x-app-layout>
    <x-slot name="pageTitle">Katalog Buku</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl md:text-3xl text-gray-900 leading-tight tracking-tight">Katalog Buku</h2>
                <div class="flex flex-wrap items-center gap-2 mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] md:text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                        {{ $bukus->total() }} Koleksi Tersedia
                    </span>
                    <p class="text-xs md:text-sm text-gray-400 font-medium italic">jelajahi dan pinjam buku favoritmu</p>
                </div>
            </div>
            <a href="{{ route('peminjam.cart.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="md:hidden">Keranjang</span>
                <span class="hidden md:inline">Lihat Keranjang</span>
            </a>
        </div>
    </x-slot>

    <div class="py-4 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter & Switcher Section (Glassmorphism) -->
            <div class="bg-white/70 backdrop-blur-md border border-gray-100 rounded-2xl md:rounded-[2rem] p-4 md:p-6 mb-6 md:mb-8 shadow-sm">
                <form id="searchForm" method="GET" class="flex flex-col gap-4">
                    <!-- Keep current view mode in form -->
                    <input type="hidden" name="view" id="viewModeInput" value="{{ $viewMode }}">

                    <div class="flex flex-col md:flex-row items-center gap-3">
                        <!-- Search -->
                        <div class="flex-1 w-full relative">
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" 
                                    placeholder="Cari judul, penulis..." 
                                    class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border-transparent rounded-xl md:rounded-[1.5rem] text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-400 focus:bg-white transition-all outline-none"
                                    autocomplete="off">
                            </div>
                        </div>

                        <!-- Genre Select & View Switcher (Desktop only view switcher for simplicity, or keep both) -->
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <select name="genre_id" id="genreSelect"
                                class="flex-1 md:w-48 pl-4 pr-10 py-3 bg-gray-50/50 border-transparent rounded-xl md:rounded-[1.5rem] text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-400 focus:bg-white transition-all appearance-none outline-none">
                                <option value="">📁 Semua Genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->nama_genre }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- VIEW SWITCHER - Hidden on very small mobile to save space if needed, but let's keep it responsive -->
                            <div class="hidden sm:flex items-center gap-1 bg-gray-100 p-1 rounded-xl md:rounded-2xl border border-gray-200">
                                <button type="button" onclick="switchView('card')" 
                                   class="view-btn p-2 rounded-lg md:rounded-xl transition-all {{ $viewMode === 'card' ? 'bg-white shadow-sm text-indigo-600' : 'text-gray-400 hover:text-gray-600' }}"
                                   data-view="card">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                </button>
                                <button type="button" onclick="switchView('table')" 
                                   class="view-btn p-2 rounded-lg md:rounded-xl transition-all {{ $viewMode === 'table' ? 'bg-white shadow-sm text-indigo-600' : 'text-gray-400 hover:text-gray-600' }}"
                                   data-view="table">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- BOOKS LIST CONTAINER -->
            <div id="booksListContainer" class="transition-opacity duration-300">
                @include('peminjam.katalog._list')
            </div>

        </div>
    </div>

    <!-- CART OVERLAY CONTAINER -->
    <div id="cartOverlayWrapper">
        @include('peminjam.katalog._cart_overlay')
    </div>

    <script>
        function incrementQty(id, max) {
            const input = document.getElementById(id);
            const currentVal = parseInt(input.value);
            if (currentVal < max) {
                input.value = currentVal + 1;
            }
        }

        function decrementQty(id) {
            const input = document.getElementById(id);
            const currentVal = parseInt(input.value);
            if (currentVal > 1) {
                input.value = currentVal - 1;
            }
        }

        function toggleCartPreview() {
            const preview = document.getElementById('cartPreview');
            if (preview) {
                preview.classList.toggle('show');
            }
        }

        // AJAX Logic
        let searchTimer;
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const genreSelect = document.getElementById('genreSelect');
        const container = document.getElementById('booksListContainer');
        const loader = document.getElementById('searchLoader');
        const viewInput = document.getElementById('viewModeInput');
        const cartWrapper = document.getElementById('cartOverlayWrapper');

        async function performSearch(url = null) {
            if (!url) {
                const formData = new FormData(searchForm);
                const params = new URLSearchParams(formData);
                url = `{{ route('peminjam.katalog.index') }}?${params.toString()}`;
            }

            loader.classList.remove('hidden');
            container.style.opacity = '0.5';

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                
                if (response.ok) {
                    const html = await response.text();
                    container.innerHTML = html;
                    window.history.pushState({}, '', url);
                    initPageInteractions();
                }
            } catch (error) {
                console.error('Search failed:', error);
            } finally {
                loader.classList.add('hidden');
                container.style.opacity = '1';
            }
        }

        async function refreshCartOverlay() {
            try {
                const response = await fetch("{{ route('peminjam.katalog.cartOverlay') }}", {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (response.ok) {
                    const html = await response.text();
                    cartWrapper.innerHTML = html;
                }
            } catch (error) {
                console.error('Cart refresh failed:', error);
            }
        }

        async function addToCartAjax(form) {
            const formData = new FormData(form);
            const url = form.action;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });

                if (response.ok) {
                    await refreshCartOverlay();
                    Toast.success("Buku berhasil ditambahkan ke keranjang!", 2000);
                }
            } catch (error) {
                console.error('Add to cart failed:', error);
                Toast.error("Gagal menambahkan buku ke keranjang.");
            }
        }

        function initPageInteractions() {
            // Re-init pagination
            document.querySelectorAll('.ajax-pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    performSearch(this.href);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });

            // Re-init add to cart forms
            document.querySelectorAll('form[action*="cart/add"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    addToCartAjax(this);
                });
            });
        }

        function switchView(mode) {
            viewInput.value = mode;
            document.querySelectorAll('.view-btn').forEach(btn => {
                if (btn.getAttribute('data-view') === mode) {
                    btn.classList.add('bg-white', 'shadow-sm', 'text-indigo-600');
                    btn.classList.remove('text-gray-400');
                } else {
                    btn.classList.remove('bg-white', 'shadow-sm', 'text-indigo-600');
                    btn.classList.add('text-gray-400');
                }
            });
            performSearch();
        }

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => performSearch(), 300);
            });
        }

        if (genreSelect) {
            genreSelect.addEventListener('change', () => performSearch());
        }

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            performSearch();
        });

        document.addEventListener('DOMContentLoaded', initPageInteractions);
    </script>

    <style>
        /* Hide number input spinners */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</x-app-layout>