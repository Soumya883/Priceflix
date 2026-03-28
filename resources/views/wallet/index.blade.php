<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 flex items-center justify-center border border-cyan-500/20 shadow-lg shadow-cyan-500/10">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-white tracking-tight">Financial Hub</h2>
                    <p class="text-xs font-bold text-cyan-500 uppercase tracking-widest">Asset Management & Portfolio Overview</p>
                </div>
            </div>
            <div class="flex gap-8">
                <div class="text-right border-r border-white/5 pr-8">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Available to Trade</p>
                    <p class="text-2xl font-black text-emerald-400 tracking-tighter">${{ number_format($totalAvailableUsd, 2) }} <span class="text-xs text-slate-500">USD</span></p>
                </div>
                @if($totalLockedUsd > 0)
                    <div class="text-right border-r border-white/5 pr-8">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Locked / In Trade</p>
                        <p class="text-2xl font-black text-amber-500 tracking-tighter">${{ number_format($totalLockedUsd, 2) }} <span class="text-xs text-slate-500">USD</span></p>
                    </div>
                @endif
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Net Worth</p>
                    <p class="text-2xl font-black text-white tracking-tighter">${{ number_format($totalUsdValue, 2) }} <span class="text-xs text-slate-500">USD</span></p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Asset Breakdown -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <h3 class="text-lg font-black text-white tracking-tight">Portfolio Allocation</h3>
                        <div class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                            <span>Balance</span>
                            <span class="text-white/20">|</span>
                            <span>Evaluation</span>
                        </div>
                    </div>

                    <div class="grid gap-4">
                        @foreach ($wallets as $wallet)
                            <div class="glass-card p-5 hover:bg-white/[0.03] transition-all group border-l-4 {{ $wallet->asset->symbol === 'USD' ? 'border-cyan-500' : 'border-violet-500' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-slate-900 border border-white/5 flex items-center justify-center font-black text-white text-xs shadow-inner">
                                            {{ $wallet->asset->symbol }}
                                        </div>
                                        <div>
                                            <div class="text-md font-black text-white">{{ $wallet->asset->name }}</div>
                                            <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Digital Asset Account</div>
                                        </div>
                                    </div>
                                    <div class="text-right flex flex-col items-end gap-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Available</span>
                                            <div class="text-lg font-black text-white tracking-tighter">{{ number_format($wallet->balance, 8) }} <span class="text-[10px] text-slate-500">{{ $wallet->asset->symbol }}</span></div>
                                        </div>
                                        @if($wallet->locked_balance > 0)
                                            <div class="flex items-center gap-2 px-2 py-0.5 rounded bg-amber-500/5 border border-amber-500/10">
                                                <span class="text-[9px] font-black text-amber-500/50 uppercase tracking-widest">In Trade/Pending</span>
                                                <div class="text-xs font-black text-amber-500/80 tracking-tighter">{{ number_format($wallet->locked_balance, 8) }}</div>
                                            </div>
                                        @endif
                                        <div class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest mt-1">
                                            @if($wallet->asset->symbol === 'USD')
                                                Base Currency
                                            @else
                                                Live Value Active
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Transaction History -->
                    <div class="mt-12">
                        <div class="flex items-center justify-between mb-6 px-2">
                            <h3 class="text-lg font-black text-white tracking-tight">Recent Activity</h3>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Last 10 Transactions</span>
                        </div>
                        
                        <div class="glass-card overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-white/5 bg-white/[0.02]">
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Type</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Asset</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @forelse($transactions as $tx)
                                        <tr class="hover:bg-white/[0.01] transition-colors">
                                            <td class="px-6 py-4">
                                                <span class="text-[10px] font-black uppercase tracking-widest {{ $tx->type === 'deposit' ? 'text-cyan-400' : ($tx->type === 'withdrawal' ? 'text-rose-400' : 'text-amber-400') }}">
                                                    {{ $tx->type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-xs font-bold text-white uppercase">{{ $tx->asset->symbol }}</td>
                                            <td class="px-6 py-4 text-xs font-black text-white">{{ number_format($tx->amount, 8) }}</td>
                                            <td class="px-6 py-4">
                                                @if($tx->status === 'pending')
                                                    <span class="px-2 py-1 rounded-md bg-amber-500/10 border border-amber-500/20 text-[10px] font-black text-amber-500 uppercase tracking-widest">Pending</span>
                                                @elseif($tx->status === 'approved')
                                                    <span class="px-2 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-black text-emerald-500 uppercase tracking-widest">Approved</span>
                                                @else
                                                    <span class="px-2 py-1 rounded-md bg-rose-500/10 border border-rose-500/20 text-[10px] font-black text-rose-500 uppercase tracking-widest">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-tight">{{ $tx->created_at->format('M d, H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">No Transaction History Recorded</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Transaction Sidebar -->
                <div class="space-y-6">
                    <!-- Deposit Module: Multi-Option -->
                    <div class="glass-card p-6 border-cyan-500/20 bg-gradient-to-br from-cyan-500/5 to-transparent shadow-xl" x-data="{ method: 'bank' }">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Fund Account</h4>
                        </div>

                        <!-- Method Selector -->
                        <div class="grid grid-cols-3 gap-2 mb-6">
                            <button @click="method = 'bank'" :class="method === 'bank' ? 'bg-cyan-500/20 border-cyan-500/50 text-white' : 'border-white/5 text-slate-500'" class="p-2 rounded-lg border text-[8px] font-black uppercase tracking-widest transition-all">Bank</button>
                            <button @click="method = 'crypto'" :class="method === 'crypto' ? 'bg-cyan-500/20 border-cyan-500/50 text-white' : 'border-white/5 text-slate-500'" class="p-2 rounded-lg border text-[8px] font-black uppercase tracking-widest transition-all">Crypto</button>
                            <button @click="method = 'manual'" :class="method === 'manual' ? 'bg-cyan-500/20 border-cyan-500/50 text-white' : 'border-white/5 text-slate-500'" class="p-2 rounded-lg border text-[8px] font-black uppercase tracking-widest transition-all">Staff</button>
                        </div>

                        <form action="{{ route('wallet.deposit') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="method" :value="method">
                            
                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block">Asset to Fund</label>
                                <select name="asset_id" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-cyan-500 transition-colors">
                                    @foreach($wallets as $wallet)
                                        <option value="{{ $wallet->asset->id }}">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block">Quantity</label>
                                <input type="number" step="any" name="amount" placeholder="0.00" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-cyan-500 transition-colors" required>
                            </div>

                            <!-- Dynamic Method Fields -->
                            <div x-show="method === 'bank'" class="p-3 rounded-xl bg-slate-900/50 border border-white/5 space-y-3">
                                <p class="text-[9px] font-bold text-slate-500 leading-tight uppercase tracking-tighter">Transfer to: **HSBC Main 0987-1234-5**</p>
                                <div>
                                    <label class="text-[9px] font-black text-cyan-500/50 uppercase tracking-widest mb-1 block">Reference # / UTR</label>
                                    <input type="text" name="reference_id" placeholder="Enter Ref ID" class="w-full bg-transparent border-0 border-b border-white/10 p-1 text-xs text-white focus:ring-0 focus:border-cyan-500 transition-colors">
                                </div>
                            </div>

                            <div x-show="method === 'crypto'" class="p-3 rounded-xl bg-slate-900/50 border border-white/5">
                                <p class="text-[9px] font-bold text-slate-500 leading-tight uppercase tracking-tighter mb-2">Network: **ERC-20 / BEP-20**</p>
                                <div class="bg-black/40 p-2 rounded font-mono text-[9px] text-cyan-400 break-all border border-cyan-500/10 shrink-0">
                                    0x71C7656EC7ab88b098defB751B7401B5f6d8976F
                                </div>
                                <p class="text-[8px] font-black text-amber-500/50 uppercase mt-2">Send only supported assets</p>
                            </div>

                            <div x-show="method === 'manual'" class="p-3 rounded-xl bg-slate-900/50 border border-white/5">
                                <p class="text-[9px] font-bold text-slate-500 leading-tight uppercase tracking-tighter">Staff Assistance Required</p>
                                <p class="text-[8px] font-black text-slate-600 uppercase mt-1">Manual verification may take up to 24 hours.</p>
                            </div>

                            <button type="submit" class="w-full py-4 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-cyan-500/20 border-t border-white/10">Confirm Intent</button>
                        </form>
                    </div>

                    <!-- Withdrawal Module -->
                    <div class="glass-card p-6 border-rose-500/20 bg-gradient-to-br from-rose-500/5 to-transparent">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-rose-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Vault Withdrawal</h4>
                        </div>
                        <form action="{{ route('wallet.withdraw') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block">Source Account</label>
                                <select name="asset_id" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-rose-500 transition-colors">
                                    @foreach($wallets as $wallet)
                                        <option value="{{ $wallet->asset->id }}">{{ $wallet->asset->name }} ({{ $wallet->asset->symbol }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block">Quantity</label>
                                <input type="number" step="any" name="amount" placeholder="0.00" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-rose-500 transition-colors">
                            </div>
                            <button type="submit" class="w-full py-4 rounded-xl bg-rose-600/20 hover:bg-rose-600/40 border border-rose-500/30 text-rose-400 text-[10px] font-black uppercase tracking-widest transition-all">Execute Withdraw</button>
                        </form>
                    </div>

                    <!-- Verification Notice -->
                    <div class="p-4 rounded-xl border border-white/5 bg-white/5">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] font-bold text-slate-500 uppercase leading-snug">All transactions are simulated for verification purposes. Real funds are not being processed in this session.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
