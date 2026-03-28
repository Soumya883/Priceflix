<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-100 bg-[#0b0e14] selection:bg-cyan-500/30">
        <div class="min-h-screen flex relative overflow-x-hidden">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col min-w-0 relative z-10">
                <!-- Page Heading (Optional but kept for continuity) -->
                @isset($header)
                    <header class="bg-slate-900/50 border-b border-white/5 backdrop-blur-md sticky top-0 z-40">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Global Background Blobs -->
                <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden opacity-30">
                    <div class="absolute bg-cyan-600/20 w-96 h-96 rounded-full -top-20 -left-20 blur-[120px]"></div>
                    <div class="absolute bg-violet-600/20 w-[30rem] h-[30rem] rounded-full -bottom-20 -right-20 blur-[120px]"></div>
                </div>

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        <!-- Global Notifications Portal -->
        @if(session('success') || session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-8 right-8 z-[100] animate-slide-up">
                <div class="glass-card p-4 flex items-center gap-4 border border-white/10 shadow-2xl min-w-[300px] {{ session('success') ? 'bg-emerald-500/10' : 'bg-rose-500/10' }}">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ session('success') ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                        @if(session('success'))
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        @endif
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-0.5">{{ session('success') ? 'Success' : 'Attention' }}</div>
                        <div class="text-xs font-bold text-white uppercase">{{ session('success') ?? session('error') }}</div>
                    </div>
                </div>
            </div>
        @endif
    </body>
</html>
