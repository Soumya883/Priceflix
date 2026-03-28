@props(['active', 'icon', 'title', 'color' => 'cyan'])

@php
$classes = ($active ?? false)
            ? "flex items-center gap-4 p-3 rounded-2xl bg-$color-500/10 text-$color-400 border border-$color-500/20 shadow-lg shadow-$color-500/10 group-hover:px-4 transition-all duration-300"
            : "flex items-center gap-4 p-3 rounded-2xl text-slate-400 hover:bg-white/5 hover:text-white border border-transparent group-hover:px-4 transition-all duration-300";

$iconClasses = ($active ?? false)
            ? "w-6 h-6 flex-shrink-0 text-$color-400"
            : "w-6 h-6 flex-shrink-0 text-slate-500 group-hover:text-white transition-colors duration-300";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon === 'chart-bar')
        <svg class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
        </svg>
    @elseif($icon === 'wallet')
        <svg class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
    @elseif($icon === 'clock')
        <svg class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    @elseif($icon === 'badge-check')
        <svg class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
    @elseif($icon === 'shield-check')
        <svg class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
    @endif
    
    <span class="text-xs font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity duration-300 overflow-hidden whitespace-nowrap">
        {{ $title }}
    </span>
</a>
