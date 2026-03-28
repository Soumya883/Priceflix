@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1']) }}>
    {{ $value ?? $slot }}
</label>
