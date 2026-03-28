@props(['active', 'title'])

@php
$classes = ($active ?? false)
            ? 'block px-6 py-4 rounded-2xl bg-cyan-500/10 text-cyan-400 font-black text-sm uppercase tracking-widest border border-cyan-500/20'
            : 'block px-6 py-4 rounded-2xl text-slate-400 hover:bg-white/5 hover:text-white font-black text-sm uppercase tracking-widest border border-transparent transition-all';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $title }}
</a>
