<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PriceFlex - Crypto Gateway</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-100 bg-[#0b0e14] selection:bg-cyan-500/30">
        <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden">
            <!-- Background Decoration -->
            <div class="fixed inset-0 z-0 pointer-events-none">
                <div class="absolute bg-cyan-600/10 w-96 h-96 rounded-full -top-20 -left-20 blur-[100px]"></div>
                <div class="absolute bg-violet-600/10 w-[30rem] h-[30rem] rounded-full -bottom-20 -right-20 blur-[100px]"></div>
            </div>

            <div class="relative z-10 mb-8 sm:mb-12">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-cyan-500 to-violet-500 flex items-center justify-center p-[1px] shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-all duration-300">
                        <div class="w-full h-full bg-[#0b0e14] rounded-[10px] flex items-center justify-center">
                            <svg class="w-6 h-6 text-cyan-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-3xl font-extrabold tracking-tighter text-white group-hover:text-cyan-300 transition-colors">PriceFlex</span>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md px-8 py-10 glass-card mx-4">
                {{ $slot }}
            </div>

            <div class="relative z-10 mt-8 text-slate-500 text-xs font-medium uppercase tracking-widest">
                Protected by PriceFlex Sentinel™
            </div>
        </div>
    </body>
</html>
