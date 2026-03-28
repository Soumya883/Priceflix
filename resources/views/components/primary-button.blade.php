<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-black text-xs uppercase tracking-widest shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 hover:-translate-y-0.5 active:scale-95 transition-all duration-200 outline-none focus:ring-2 focus:ring-cyan-500/50']) }}>
    {{ $slot }}
</button>
