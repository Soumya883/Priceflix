<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-violet-500/10 flex items-center justify-center border border-violet-500/20 shadow-lg shadow-violet-500/10">
                    <svg class="w-6 h-6 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-white tracking-tight">Admin Control Center</h2>
                    <p class="text-xs font-bold text-violet-500 uppercase tracking-widest">PriceFlex Platform Governance</p>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-3 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Platform Integrity: Optimal</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- System Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="glass-card p-6 group hover:translate-y-[-2px] transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 border border-cyan-500/10">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/10">Live</span>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Total Traders</p>
                    <p class="text-3xl font-black text-white">{{ number_format($stats['users']) }}</p>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-cyan-500 rounded-full w-2/3"></div>
                    </div>
                </div>

                <div class="glass-card p-6 group hover:translate-y-[-2px] transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-500/10 flex items-center justify-center text-violet-400 border border-violet-500/10">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-violet-400 bg-violet-500/10 px-2 py-0.5 rounded-full border border-violet-500/10">Active</span>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Open Orders</p>
                    <p class="text-3xl font-black text-white">{{ number_format($stats['pending_orders']) }}</p>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-violet-500 rounded-full w-1/4"></div>
                    </div>
                </div>

                <div class="glass-card p-6 group hover:translate-y-[-2px] transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/10">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/10">+12%</span>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Cumulative Volume</p>
                    <p class="text-3xl font-black text-white">{{ number_format($stats['total_volume'], 2) }} <span class="text-xs text-slate-500">UNIT</span></p>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full w-4/5"></div>
                    </div>
                </div>

                <div class="glass-card p-6 group hover:translate-y-[-2px] transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 border border-amber-500/10">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 bg-white/5 px-2 py-0.5 rounded-full border border-white/10">Global</span>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Active Markets</p>
                    <p class="text-3xl font-black text-white">{{ $stats['markets'] }}</p>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-500 rounded-full w-full"></div>
                    </div>
                </div>
            </div>
            
            <!-- Identity Governance: Pending Verifications -->
            <div class="mb-8 overflow-hidden">
                <div class="flex items-center justify-between mb-4 px-2">
                    <h3 class="text-lg font-black text-white tracking-tight">Identity Governance (KYC)</h3>
                    <div class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                        <span class="text-violet-400">Security Audit Required</span>
                        <span class="text-white/20">|</span>
                        <span>{{ $pendingDocuments->count() }} Pending</span>
                    </div>
                </div>

                <div class="glass-card shadow-2xl shadow-black/50 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.02] border-b border-white/5">
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Trader</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Doc Type</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Asset Link</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Submitted</th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Verification Hub</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($pendingDocuments as $doc)
                                    <tr class="hover:bg-white/[0.01] transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-white">{{ $doc->user->name }}</div>
                                            <div class="text-[10px] text-slate-500 font-medium uppercase tracking-tight">{{ $doc->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded-md text-[10px] font-black uppercase tracking-widest bg-violet-500/10 text-violet-400 border border-violet-500/20">
                                                {{ str_replace('_', ' ', $doc->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-[10px] font-black text-cyan-400 uppercase tracking-widest hover:text-cyan-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View Document
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-tighter">
                                            {{ $doc->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 text-xs">
                                                <form action="{{ route('admin.documents.approve', $doc) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all">
                                                        Approve
                                                    </button>
                                                </form>
                                                
                                                <button 
                                                    x-data=""
                                                    @click="$dispatch('open-modal', 'reject-doc-{{ $doc->id }}')"
                                                    class="p-2 rounded-lg bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                                                    Reject
                                                </button>

                                                <!-- Reject Modal -->
                                                <x-modal name="reject-doc-{{ $doc->id }}" focusable>
                                                    <div class="p-8">
                                                        <h2 class="text-xl font-black text-white uppercase tracking-tight mb-2">Reject Identity Document</h2>
                                                        <form action="{{ route('admin.documents.reject', $doc) }}" method="POST" class="space-y-6">
                                                            @csrf
                                                            <div>
                                                                <x-input-label for="reason" value="Rejection Reason" class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 text-slate-400" />
                                                                <x-text-input name="reason" type="text" class="w-full" placeholder="e.g., Image too blurry, Invalid ID type" required />
                                                            </div>
                                                            <div class="flex justify-end gap-3 mt-8">
                                                                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                                                <x-primary-button class="bg-rose-600 hover:bg-rose-500 border-none uppercase tracking-widest text-xs font-black p-4">Confirm Rejection</x-primary-button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </x-modal>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-[10px] font-black uppercase tracking-[0.3em] opacity-30">
                                            Zero Pending Verifications
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Financial Governance: Pending Transactions -->
            <div class="mb-8 overflow-hidden">
                <div class="flex items-center justify-between mb-4 px-2">
                    <h3 class="text-lg font-black text-white tracking-tight">Financial Governance</h3>
                    <div class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                        <span class="text-amber-400">Review Required</span>
                        <span class="text-white/20">|</span>
                        <span>{{ $pendingTransactions->count() }} Pending</span>
                    </div>
                </div>

                <div class="glass-card shadow-2xl shadow-black/50 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.02] border-b border-white/5">
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Trader</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Operation</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Method</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Asset</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Initiated</th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Approval Hub</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($pendingTransactions as $tx)
                                    <tr class="hover:bg-white/[0.01] transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-white">{{ $tx->user->name }}</div>
                                            <div class="text-[10px] text-slate-500 font-medium uppercase tracking-tight">{{ $tx->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded-md text-[10px] font-black uppercase tracking-widest {{ $tx->type === 'deposit' ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                                {{ $tx->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-[10px] font-black text-white uppercase tracking-widest">{{ $tx->method ?? 'N/A' }}</div>
                                            @if($tx->reference_id)
                                                <div class="text-[9px] font-mono text-cyan-500 mt-1 uppercase">Ref: {{ $tx->reference_id }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-xs font-black text-white uppercase">{{ $tx->asset->symbol }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-black text-white tracking-tighter">{{ number_format($tx->amount, 8) }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-tighter">
                                            {{ $tx->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 text-xs">
                                                <form action="{{ route('admin.transactions.approve', $tx) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.transactions.reject', $tx) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-2 opacity-30">
                                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">All Financial Requests Processed</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- User Management Table -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between mb-2 px-2">
                        <h3 class="text-lg font-black text-white tracking-tight">Trader Management</h3>
                        <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            Total: {{ $users->total() }} Records
                        </div>
                    </div>
                    
                    <div class="glass-card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white/5 border-b border-white/5">
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">User Entity</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Portfolio Value</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Access Level</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Registered</th>
                                        <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Operations</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-white/[0.02] transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 border border-white/10 flex items-center justify-center text-xs font-bold text-cyan-400 shadow-inner group-hover:border-cyan-500/50 transition-colors">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-bold text-white">{{ $user->name }}</div>
                                                        <div class="text-xs text-slate-500 font-medium">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @forelse($user->wallets as $wallet)
                                                        @if($wallet->balance > 0)
                                                            <span class="text-[9px] font-black text-white bg-slate-800 px-1.5 py-0.5 rounded border border-white/5">
                                                                {{ number_format($wallet->balance, 2) }} {{ $wallet->asset->symbol }}
                                                            </span>
                                                        @endif
                                                    @empty
                                                        <span class="text-[9px] font-black text-slate-600 uppercase">Empty</span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($user->is_admin)
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-violet-500/10 border border-violet-500/20 text-[10px] font-black text-violet-400 uppercase tracking-wider shadow-[0_0_10px_rgba(139,92,246,0.1)]">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-violet-500 shadow-[0_0_5px_rgba(139,92,246,0.8)]"></span>
                                                        Administrator
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-500/10 border border-white/5 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                                                        Standard
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-tighter">
                                                {{ $user->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button 
                                                        x-data=""
                                                        @click="$dispatch('open-modal', 'send-money-{{ $user->id }}')"
                                                        class="p-2 rounded-lg border border-white/5 hover:border-emerald-500/50 hover:bg-emerald-500/10 text-slate-400 hover:text-emerald-400 transition-all group/btn"
                                                        title="Send Money / Credit Account">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>

                                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" 
                                                            @if(auth()->id() === $user->id) disabled @endif
                                                            class="p-2 rounded-lg border border-white/5 hover:border-violet-500/50 hover:bg-violet-500/10 text-slate-400 hover:text-violet-400 transition-all disabled:opacity-30 disabled:cursor-not-allowed group/btn"
                                                            title="{{ $user->is_admin ? 'Demote to User' : 'Promote to Admin' }}">
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Send Money Modal -->
                                                <x-modal name="send-money-{{ $user->id }}" focusable>
                                                    <div class="p-8">
                                                        <h2 class="text-xl font-black text-white uppercase tracking-tight mb-2">Fund User Account</h2>
                                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-8">Direct credit for {{ $user->name }}</p>
                                                        
                                                        <form action="{{ route('admin.users.send-money', $user) }}" method="POST" class="space-y-6">
                                                            @csrf
                                                            <div>
                                                                <x-input-label for="asset_id" value="Select Asset Class" class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 text-slate-400" />
                                                                <select name="asset_id" class="w-full bg-slate-900 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-emerald-500 transition-colors">
                                                                    @foreach(App\Models\Asset::all() as $asset)
                                                                        <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->symbol }})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <x-input-label for="amount" value="Amount to Credit" class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 text-slate-400" />
                                                                <x-text-input name="amount" type="number" step="any" class="w-full" placeholder="0.00" required />
                                                            </div>

                                                            <div>
                                                                <x-input-label for="notes" value="Internal Annotation" class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 text-slate-400" />
                                                                <x-text-input name="notes" type="text" class="w-full" placeholder="e.g., Promotional credit, Refund, etc." />
                                                            </div>

                                                            <div class="flex justify-end gap-3 mt-8">
                                                                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                                                <x-primary-button class="bg-emerald-600 hover:bg-emerald-500 border-none">Confirm Credit</x-primary-button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </x-modal>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 bg-white/5 border-t border-white/5">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>

                <!-- Recent Order Activity -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between mb-2 px-2">
                        <h3 class="text-lg font-black text-white tracking-tight">System Intake</h3>
                        <a href="#" class="text-[10px] font-black text-cyan-500 uppercase tracking-widest hover:underline">Full Log</a>
                    </div>
                    
                    <div class="glass-card p-2">
                        <div class="space-y-1">
                            @foreach ($recentOrders as $order)
                                <div class="px-4 py-3 rounded-xl hover:bg-white/5 transition-all border border-transparent hover:border-white/5 group">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="text-[10px] font-black {{ $order->side === 'buy' ? 'text-emerald-500' : 'text-rose-500' }} uppercase tracking-widest px-2 py-0.5 rounded bg-{{ $order->side === 'buy' ? 'emerald' : 'rose' }}-500/10">
                                                {{ $order->side }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-white group-hover:text-cyan-400 transition-colors">{{ $order->market->symbol }}</div>
                                                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $order->user->name }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-bold text-slate-200">{{ number_format($order->quantity, 4) }}</div>
                                            <div class="text-[10px] font-bold text-slate-600 uppercase tracking-tighter">{{ $order->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Platform Status Hub -->
                    <div class="glass-card p-6 bg-gradient-to-br from-violet-500/10 to-transparent border-violet-500/20">
                        <h4 class="text-sm font-black text-white uppercase tracking-widest mb-4">Engineering Status</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-xs font-bold text-slate-400">
                                <span class="uppercase tracking-widest">Matching Engine</span>
                                <span class="text-emerald-400">0.4ms Latency</span>
                            </div>
                            <div class="flex justify-between items-center text-xs font-bold text-slate-400">
                                <span class="uppercase tracking-widest">Database Cluster</span>
                                <span class="text-emerald-400">Degraded: No</span>
                            </div>
                            <div class="flex justify-between items-center text-xs font-bold text-slate-400">
                                <span class="uppercase tracking-widest">Websocket Relay</span>
                                <span class="text-amber-400">Active - 2M Connections</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
