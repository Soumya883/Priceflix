<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight uppercase">History <span class="text-cyan-500">Hub</span></h2>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mt-1">Complete audit of your trading activity</p>
            </div>
            <div class="flex gap-4">
                <div class="glass-card px-4 py-2 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Live Sync Active</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'orders' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Tab Navigation -->
            <div class="flex items-center gap-2 p-1 bg-slate-900/50 rounded-2xl border border-white/5 w-fit">
                <button 
                    @click="tab = 'orders'"
                    :class="tab === 'orders' ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/20' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Order History
                </button>
                <button 
                    @click="tab = 'trades'"
                    :class="tab === 'trades' ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/20' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Trade Executions
                </button>
            </div>

            <!-- Orders Table -->
            <div x-show="tab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="glass-card overflow-hidden shadow-2xl shadow-black/50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.02] border-b border-white/5">
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Market</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Side</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Price</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Quantity</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Filled</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-white/[0.01] transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-black text-white uppercase">{{ $order->market->symbol }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-[10px] font-black uppercase tracking-widest {{ $order->side === 'buy' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                                {{ $order->side }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-tight">{{ $order->type }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-white tracking-tighter">{{ number_format($order->price, 8) }}</div>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-xs text-slate-400">
                                            {{ number_format($order->quantity, 8) }}
                                        </td>
                                        <td class="px-6 py-4 font-mono text-xs text-cyan-400">
                                            {{ number_format($order->filled_quantity, 8) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-800 text-slate-300 border border-white/5">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-[10px] font-bold text-slate-500">
                                            {{ $order->created_at->format('M d, H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">No orders found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>

            <!-- Trades Table -->
            <div x-show="tab === 'trades'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="glass-card overflow-hidden shadow-2xl shadow-black/50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.02] border-b border-white/5">
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Execution ID</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Market</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Price</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Quantity</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total (Notional)</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($trades as $trade)
                                    <tr class="hover:bg-white/[0.01] transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-[10px] font-mono text-slate-500">#TX-{{ $trade->id }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-black text-white uppercase">{{ $trade->market->symbol }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-white tracking-tighter">
                                            {{ number_format($trade->price, 8) }}
                                        </td>
                                        <td class="px-6 py-4 font-mono text-xs text-slate-400">
                                            {{ number_format($trade->quantity, 8) }}
                                        </td>
                                        <td class="px-6 py-4 font-mono text-xs text-emerald-400">
                                            {{ number_format($trade->notional, 8) }}
                                        </td>
                                        <td class="px-6 py-4 text-[10px] font-bold text-slate-400">
                                            {{ $trade->created_at->format('M d, H:i:s') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">No trade executions found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $trades->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
