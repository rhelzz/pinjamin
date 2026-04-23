@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-100 bg-gray-50/50 focus:bg-white focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl shadow-sm transition-all duration-300']) }}>
