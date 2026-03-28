<nav x-data="{ open: false }" class="relative z-50">
    <!-- Desktop Sidebar -->
    <div class="hidden lg:flex flex-col w-24 hover:w-64 group bg-[#0b0e14]/80 backdrop-blur-2xl border-r border-white/5 h-screen sticky top-0 transition-all duration-300 ease-in-out">
        <!-- Logo -->
        <div class="p-6 flex justify-center group-hover:justify-start items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-violet-500 p-[1px] flex-shrink-0">
                <div class="w-full h-full bg-[#0b0e14] rounded-[10px] flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <span class="text-xl font-black text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">PriceFlex</span>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 px-4 space-y-2 py-4">
            <x-nav-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="chart-bar" title="Trade" />
            <x-nav-sidebar-link :href="route('wallet.index')" :active="request()->routeIs('wallet.index')" icon="wallet" title="Wallets" />
            <x-nav-sidebar-link :href="route('history.index')" :active="request()->routeIs('history.index')" icon="clock" title="History" />
            <x-nav-sidebar-link :href="route('verification.index')" :active="request()->routeIs('verification.index')" icon="badge-check" title="Verify" />
            
            @if (Auth::user()->is_admin)
                <div class="pt-4 pb-2">
                    <div class="h-px bg-white/5 mb-4 group-hover:mx-2 transition-all"></div>
                </div>
                <x-nav-sidebar-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" icon="shield-check" title="Admin" color="violet" />
            @endif
        </div>

        <!-- User Profile Bottom -->
        <!-- User Profile Bottom -->
        <div class="p-4 border-t border-white/5 bg-white/[0.02]">
            <x-dropdown align="left" width="64">
                <x-slot name="trigger">
                    <button class="w-full h-12 flex items-center gap-3 p-1 rounded-xl hover:bg-white/5 transition-all text-left">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 border border-white/10 flex items-center justify-center text-xs font-bold text-cyan-400 flex-shrink-0 shadow-lg group-hover:border-cyan-500/50 transition-colors">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden group-hover:block transition-all overflow-hidden whitespace-nowrap">
                            <div class="text-[11px] font-black text-white leading-none mb-1">{{ Auth::user()->name }}</div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_5px_rgba(16,185,129,0.5)]"></span>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ Auth::user()->verification_status }}</span>
                            </div>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="p-2 space-y-1 bg-slate-900 border border-white/10">
                        <div class="px-3 py-2 border-b border-white/5 mb-1">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Account Hub</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-cyan-500/10 hover:text-cyan-400">
                            Settings
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-rose-500/10 hover:text-rose-400">
                                Disconnect Session
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-[#0b0e14]/80 backdrop-blur-xl border-b border-white/5 z-50 px-4 flex items-center justify-between">
        <button @click="open = !open" class="text-slate-400 p-2">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="text-lg font-black text-white">PriceFlex</div>
        <div class="w-8 h-8 rounded-full bg-slate-800 border border-white/10"></div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="lg:hidden fixed inset-0 z-[60] bg-[#0b0e14]/95 backdrop-blur-2xl w-72 h-full shadow-2xl border-r border-white/10">
        <div class="p-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-cyan-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <span class="text-lg font-black text-white">PriceFlex</span>
            </div>
            <button @click="open = false" class="text-slate-500 hover:text-white">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        
        <div class="px-4 py-4 space-y-2 border-b border-white/5">
            <x-nav-mobile-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" title="Trade" />
            <x-nav-mobile-link :href="route('wallet.index')" :active="request()->routeIs('wallet.index')" title="Wallets" />
            <x-nav-mobile-link :href="route('history.index')" :active="request()->routeIs('history.index')" icon="clock" title="History" />
            <x-nav-mobile-link :href="route('verification.index')" :active="request()->routeIs('verification.index')" title="Verification" />
            @if (Auth::user()->is_admin)
                <x-nav-mobile-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" title="Admin Center" />
            @endif
        </div>

        <div class="p-6">
            <div class="flex items-center gap-4 mb-8 p-3 rounded-2xl bg-white/5 border border-white/5">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-500 to-violet-500 flex items-center justify-center p-[1px] shadow-lg">
                    <div class="w-full h-full bg-[#0b0e14] rounded-full flex items-center justify-center text-sm font-black text-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div>
                    <div class="text-xs font-black text-white">{{ Auth::user()->name }}</div>
                    <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ Auth::user()->verification_status }}</div>
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 border border-white/5 text-[10px] font-black text-white uppercase tracking-widest hover:bg-cyan-500/10 hover:text-cyan-400 transition-all">
                    Account Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-[10px] font-black text-rose-400 uppercase tracking-widest hover:bg-rose-500 hover:text-white transition-all">
                        Terminate Session
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
