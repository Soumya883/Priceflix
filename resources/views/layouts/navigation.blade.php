<nav x-data="{ open: false }" class="sticky top-0 z-50 glass-panel border-b border-white/5 backdrop-blur-xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-cyan-500 to-violet-500 flex items-center justify-center p-[1px] shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-all duration-300">
                            <div class="w-full h-full bg-[#0b0e14] rounded-[7px] flex items-center justify-center">
                                <svg class="w-5 h-5 text-cyan-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white group-hover:text-cyan-300 transition-colors">PriceFlex</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:flex h-full">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-cyan-500 text-cyan-400' : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700' }} text-sm font-medium transition-all duration-200">
                        Market Dashboard
                    </a>
                    <a href="{{ route('wallet.index') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('wallet.index') ? 'border-cyan-500 text-cyan-400' : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700' }} text-sm font-medium transition-all duration-200">
                        Financial Hub
                    </a>
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('admin.index') ? 'border-violet-500 text-violet-400' : 'border-transparent text-slate-400 hover:text-slate-200 hover:border-slate-700' }} text-sm font-medium transition-all duration-200">
                            Admin Terminal
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right side elements -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <!-- Global Balance Summary -->
                <a href="{{ route('wallet.index') }}" class="group flex items-center gap-3 px-4 py-1.5 rounded-full bg-cyan-500/5 border border-cyan-500/10 hover:border-cyan-500/30 hover:bg-cyan-500/10 transition-all duration-300">
                    <div class="flex flex-col items-end">
                        <span class="text-[8px] font-black text-slate-500 uppercase tracking-[0.2em] leading-none mb-0.5 group-hover:text-cyan-400/70 transition-colors">Portfolio Value</span>
                        <div class="text-xs font-black text-white tracking-tight">
                            ${{ number_format(Auth::user()->totalUsdBalance(), 2) }}
                            <span class="text-[9px] text-slate-500 group-hover:text-cyan-400 transition-colors">USD</span>
                        </div>
                    </div>
                </a>

                <!-- Quick Status -->
                <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-[10px] uppercase tracking-wider font-bold text-slate-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Terminal: Online
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-xl border border-white/5 hover:border-white/20 hover:bg-white/5 transition-all group">
                             <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 border border-white/10 flex items-center justify-center text-xs font-bold text-cyan-400 group-hover:border-cyan-500/50 transition-colors">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col items-start px-1">
                                <div class="text-[11px] font-black text-white leading-none mb-0.5 group-hover:text-cyan-300 transition-colors">{{ Auth::user()->name }}</div>
                                <div class="flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                                    <span class="text-[7px] font-black text-cyan-400 uppercase tracking-widest">Verified Pro</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-500 group-hover:text-slate-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-slate-900 border border-white/10 rounded-xl overflow-hidden shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-cyan-500/10 hover:text-cyan-400">
                                {{ __('Security Settings') }}
                            </x-dropdown-link>

                            <div class="h-px bg-white/5 mx-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="hover:bg-rose-500/10 hover:text-rose-400">
                                    {{ __('Disconnect Wallet') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/5 bg-slate-900/95 backdrop-blur-xl">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-cyan-500/10 text-cyan-400' : 'text-slate-400' }} font-medium">Dashboard</a>
            @if (Auth::user()->is_admin)
                <a href="{{ route('admin.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('admin.index') ? 'bg-violet-500/10 text-violet-400' : 'text-slate-400' }} font-medium">Admin Terminal</a>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-white/5 px-4 mb-4">
            <div class="flex items-center gap-3 px-4 py-2 mb-4">
                <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center font-bold text-cyan-400">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-rose-400 hover:bg-rose-500/10">Disconnect</button>
                </form>
            </div>
        </div>
    </div>
</nav>
