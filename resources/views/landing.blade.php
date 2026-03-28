<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PriceFlex Exchange - Next-Gen Crypto Trading</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-blob {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.6;
            animation: float 8s ease-in-out infinite alternate;
        }
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(-30px) scale(1.05); }
        }
    </style>
</head>
<body class="bg-[#0b0e14] text-slate-100 min-h-screen relative overflow-x-hidden selection:bg-cyan-500/30">
    
    <!-- Background Effects -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="hero-blob bg-cyan-600/30 w-96 h-96 rounded-full top-[-10%] left-[-10%] mix-blend-screen"></div>
        <div class="hero-blob bg-violet-600/30 w-[30rem] h-[30rem] rounded-full bottom-[-10%] right-[-10%] mix-blend-screen" style="animation-delay: 2s;"></div>
        <div class="hero-blob bg-fuchsia-600/20 w-80 h-80 rounded-full top-[30%] left-[40%] mix-blend-screen" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-panel border-b border-white/5 transition-all">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-violet-500 flex items-center justify-center p-[2px] shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-all duration-300">
                    <div class="w-full h-full bg-[#0b0e14] rounded-[10px] flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <span class="text-xl font-bold tracking-tight text-white group-hover:text-cyan-300 transition-colors">PriceFlex</span>
            </div>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="#features" class="hover:text-cyan-400 transition-colors py-2">Features</a>
                <a href="#markets" class="hover:text-cyan-400 transition-colors py-2">Markets</a>
                <a href="#pro" class="hover:text-cyan-400 transition-colors py-2">Pro Trading</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-semibold shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all transform hover:-translate-y-0.5">
                        Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 rounded-xl border border-white/10 hover:border-cyan-400/50 hover:bg-cyan-900/10 text-slate-200 font-medium transition-all">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-white text-slate-900 hover:bg-slate-100 font-bold shadow-[0_0_20px_rgba(255,255,255,0.15)] hover:shadow-[0_0_25px_rgba(255,255,255,0.25)] transition-all transform hover:-translate-y-0.5">
                        Start Trading
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="relative z-10 pt-32 pb-20 lg:pt-48 lg:pb-32 px-6">
        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-cyan-500/30 bg-cyan-500/10 text-cyan-300 text-sm font-medium mb-8">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                        </span>
                        v2.0 Beta is Live - 0% Maker Fees
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6">
                        Trade Crypto with <br class="hidden lg:block"/>
                        <span class="text-gradient bg-gradient-to-r from-cyan-400 via-blue-400 to-violet-400">Institutional</span> speed.
                    </h1>
                    
                    <p class="text-lg text-slate-400 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        PriceFlex delivers ultra-low latency execution, deep liquidity, and a beautifully designed terminal for both retail and pro traders.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold text-lg shadow-[0_0_30px_rgba(6,182,212,0.3)] hover:shadow-[0_0_40px_rgba(6,182,212,0.4)] transition-all transform hover:-translate-y-1 text-center">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-lg shadow-[0_0_30px_rgba(6,182,212,0.3)] hover:shadow-[0_0_40px_rgba(6,182,212,0.4)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                Open Free Account
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="#markets" class="w-full sm:w-auto px-8 py-4 rounded-xl glass-panel text-slate-200 font-medium hover:bg-white/5 transition-all text-center">
                                View Markets
                            </a>
                        @endauth
                    </div>
                    
                    <div class="mt-12 pt-8 border-t border-white/5 flex flex-wrap items-center justify-center lg:justify-start gap-8 opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
                        <p class="text-sm font-semibold uppercase tracking-wider text-slate-500 w-full text-center lg:text-left mb-2">Trusted by traders worldwide</p>
                        <!-- Fake logos composed of text/shapes for demo -->
                        <div class="flex items-center gap-2 text-xl font-bold text-slate-300"><div class="w-6 h-6 bg-slate-400 rounded-sm rotate-45 transform scale-75"></div> BitVantage</div>
                        <div class="flex items-center gap-2 text-xl font-bold text-slate-300"><div class="w-6 h-6 rounded-full border-2 border-slate-400 transform scale-75"></div> NovaCapital</div>
                        <div class="flex items-center gap-2 text-xl font-bold text-slate-300"><div class="w-6 h-6 bg-slate-400 rounded-tr-xl rounded-bl-xl transform scale-75"></div> QuantFlow</div>
                    </div>
                </div>
                
                <!-- Hero Abstract Dashboard UI -->
                <div class="relative w-full max-w-lg mx-auto lg:max-w-none mt-16 lg:mt-0 perspective-1000">
                    <div class="relative rounded-2xl p-1 bg-gradient-to-b from-white/10 to-transparent transform lg:rotate-y-[-10deg] lg:rotate-x-[5deg] shadow-2xl hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out">
                        <div class="rounded-xl bg-[#0f172a] overflow-hidden border border-white/5 relative glass-panel">
                            <!-- Dashboard Header Fake -->
                            <div class="h-12 border-b border-white/5 flex items-center px-4 gap-2 bg-white/5">
                                <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                                <div class="ml-4 text-xs font-mono text-slate-400 flex-1 text-center">BTC/USD - PriceFlex Terminal</div>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-between items-end mb-8">
                                    <div>
                                        <p class="text-slate-400 text-sm mb-1 font-medium">Bitcoin Price</p>
                                        <h3 class="text-3xl font-bold text-white flex items-center gap-3">
                                            $64,230.50 
                                            <span class="text-sm px-2 py-1 rounded bg-emerald-500/20 text-emerald-400">+2.4%</span>
                                        </h3>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-slate-400 text-sm mb-1 font-medium">24h Vol</p>
                                        <p class="text-lg font-semibold text-white">4.2B USD</p>
                                    </div>
                                </div>
                                
                                <!-- Fake Chart -->
                                <div class="h-40 w-full mb-6 relative flex items-end justify-between px-1">
                                    <div class="absolute inset-0 bg-gradient-to-t from-cyan-500/10 to-transparent opacity-50"></div>
                                    <svg class="absolute inset-0 w-full h-full preserve-aspect-none" viewBox="0 0 400 100" fill="none">
                                        <path d="M0 80 L 40 70 L 80 85 L 120 40 L 160 50 L 200 20 L 240 35 L 280 10 L 320 25 L 360 5 L 400 15" stroke="url(#paint0_linear)" stroke-width="3" stroke-linecap="round"/>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="0" y1="0" x2="400" y2="0" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#06b6d4" />
                                                <stop offset="1" stop-color="#8b5cf6" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <!-- Candlesticks abstract -->
                                    <div class="relative w-2 bg-emerald-500/30 rounded-full h-1/3"><div class="absolute top-2 w-full bg-emerald-400 h-1/2 rounded-full"></div></div>
                                    <div class="relative w-2 bg-rose-500/30 rounded-full h-1/2"><div class="absolute top-4 w-full bg-rose-400 h-1/3 rounded-full"></div></div>
                                    <div class="relative w-2 bg-emerald-500/30 rounded-full h-2/3"><div class="absolute top-2 w-full bg-emerald-400 h-1/2 rounded-full"></div></div>
                                    <div class="relative w-2 bg-emerald-500/30 rounded-full h-3/4"><div class="absolute top-6 w-full bg-emerald-400 h-1/2 rounded-full"></div></div>
                                    <div class="relative w-2 bg-rose-500/30 rounded-full h-2/3"><div class="absolute top-4 w-full bg-rose-400 h-2/3 rounded-full"></div></div>
                                    <div class="relative w-2 bg-emerald-500/30 rounded-full h-full"><div class="absolute top-8 w-full bg-emerald-400 h-1/3 rounded-full"></div></div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <button class="w-full py-3 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-white font-semibold transition-colors">Buy BTC</button>
                                    <button class="w-full py-3 rounded-lg bg-rose-500 hover:bg-rose-400 text-white font-semibold transition-colors">Sell BTC</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Order Book element -->
                        <div class="absolute -right-12 top-20 w-48 glass-panel rounded-xl p-4 shadow-2xl hidden lg:block border border-white/10 animate-pulse" style="animation-duration: 4s;">
                            <div class="text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wide">Recent Trades</div>
                            <div class="space-y-2 font-mono text-sm">
                                <div class="flex justify-between text-emerald-400"><span>64,230.50</span><span>0.15</span></div>
                                <div class="flex justify-between text-emerald-400"><span>64,228.00</span><span>1.42</span></div>
                                <div class="flex justify-between text-rose-400"><span>64,225.20</span><span>0.55</span></div>
                                <div class="flex justify-between text-emerald-400"><span>64,220.10</span><span>2.10</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-24 relative z-10 bg-[#06080b]/80 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold mb-6">Engineered for Performance</h2>
                <p class="text-slate-400 text-lg">Every millisecond counts. We've built PriceFlex with enterprise-grade technology to ensure your orders execute instantly.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="glass-panel p-8 rounded-2xl hover:bg-white/[0.02] transition-colors group">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Lightning Fast</h3>
                    <p class="text-slate-400 leading-relaxed">Our matching engine handles 1M+ orders per second with sub-millisecond latency. Never miss a market move.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="glass-panel p-8 rounded-2xl hover:bg-white/[0.02] transition-colors group">
                    <div class="w-14 h-14 rounded-2xl bg-violet-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Military-grade Security</h3>
                    <p class="text-slate-400 leading-relaxed">98% of user funds are stored in cold wallets with multi-signature technology and audited smart contracts.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="glass-panel p-8 rounded-2xl hover:bg-white/[0.02] transition-colors group">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Deep Liquidity</h3>
                    <p class="text-slate-400 leading-relaxed">Aggregated liquidity from top providers ensures you get the best price execution with minimal slippage.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 relative z-10 border-y border-white/5 bg-gradient-to-r from-cyan-900/20 via-[#0b0e14] to-violet-900/20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-white/10 lg:divide-x">
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-extrabold text-white mb-2">$50B+</div>
                    <div class="text-sm text-slate-400 font-medium uppercase tracking-wide">Quarterly Volume</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-extrabold text-white mb-2">2M+</div>
                    <div class="text-sm text-slate-400 font-medium uppercase tracking-wide">Verified Users</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-extrabold text-white mb-2">< 1ms</div>
                    <div class="text-sm text-slate-400 font-medium uppercase tracking-wide">Latency</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-extrabold text-white mb-2">99.99%</div>
                    <div class="text-sm text-slate-400 font-medium uppercase tracking-wide">Uptime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 relative z-10 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/10 to-transparent"></div>
        </div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-bold mb-8">Ready to start trading?</h2>
            <p class="text-xl text-slate-300 mb-10 text-balance mx-auto">Join millions of users who trust PriceFlex for their crypto journey. Registration takes less than 2 minutes.</p>
            <div class="flex flex-col sm:flex-row max-w-md mx-auto gap-3">
                <a href="{{ route('register') }}" class="w-full bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-lg font-bold py-4 px-8 rounded-xl transition-all shadow-[0_0_20px_rgba(6,182,212,0.3)] hover:shadow-[0_0_30px_rgba(6,182,212,0.5)] transform hover:-translate-y-1">
                    Create Sandbox Account
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-[#06080b] py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-gradient-to-tr from-cyan-500 to-violet-500 p-[1px]">
                    <div class="w-full h-full bg-[#0b0e14] rounded-[5px]"></div>
                </div>
                <span class="text-lg font-bold text-white tracking-tight">PriceFlex</span>
            </div>
            <p class="text-sm text-slate-500">© {{ date('Y') }} PriceFlex Exchange. All rights reserved.</p>
            <div class="flex gap-6 text-sm font-medium text-slate-400 hidden sm:flex">
                <a href="#" class="hover:text-cyan-400 transition-colors">Terms</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">Privacy</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">Fees</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">Support</a>
            </div>
        </div>
    </footer>

</body>
</html>
