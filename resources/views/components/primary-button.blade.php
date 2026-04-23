<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 border border-transparent rounded-2xl font-bold text-sm text-white tracking-wide hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.98] transition-all duration-300 shadow-lg shadow-indigo-100']) }}>
    {{ $slot }}
</button>
