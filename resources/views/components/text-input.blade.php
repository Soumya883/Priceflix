@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-slate-950/50 border-white/5 focus:border-cyan-500 focus:ring-cyan-500 rounded-xl text-white shadow-inner transition-all duration-200 placeholder:text-slate-600']) }}>
