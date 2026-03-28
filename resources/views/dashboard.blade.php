<x-app-layout>
    <div class="py-4 md:py-6 lg:py-8 px-4 sm:px-6 lg:px-8 max-w-[1600px] mx-auto">
        <!-- Dashboard Header / Ticker -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
            @foreach ($markets->take(6) as $market)
                <div class="glass-card p-4 hover:border-cyan-500/30 transition-all cursor-pointer group">
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-xs font-bold text-slate-500 tracking-wider uppercase">{{ $market->symbol }}</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded {{ $market->price_change_24h >= 0 ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }}">
                            {{ number_format($market->price_change_24h, 2) }}%
                        </span>
                    </div>
                    <div class="text-lg font-bold text-white market-price" data-id="{{ $market->id }}">
                        {{ number_format($market->last_price, 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid lg:grid-cols-12 gap-6">
            <!-- Left Column: Chart & History (8 cols) -->
            <div class="lg:col-span-8 flex flex-col gap-6">
                <!-- Main Chart Card & Order Book Side-by-Side -->
                <div class="grid lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-3 glass-card overflow-hidden h-[550px]">
                        <div class="p-4 border-b border-white/5 flex items-center justify-between bg-white/[0.02]">
                            <div class="flex items-center gap-4">
                                <h3 class="font-bold text-white flex items-center gap-2">
                                    <span id="active-pair-display" class="text-cyan-400 uppercase tracking-tighter text-lg">BTC/USD</span>
                                    <span class="text-slate-500 text-[10px] font-black uppercase tracking-widest border border-white/5 px-2 py-0.5 rounded">Terminal 1.0</span>
                                </h3>
                                <div class="flex gap-1">
                                    <button class="px-2 py-1 rounded bg-cyan-500/10 text-cyan-400 text-[10px] font-bold uppercase tracking-tighter">1m</button>
                                    <button class="px-2 py-1 rounded hover:bg-white/5 text-slate-400 text-[10px] font-bold uppercase tracking-tighter">5m</button>
                                    <button class="px-2 py-1 rounded hover:bg-white/5 text-slate-400 text-[10px] font-bold uppercase tracking-tighter">15m</button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 h-[480px]" id="main-chart"></div>
                    </div>

                    <!-- Live Order Book -->
                    <div class="glass-card flex flex-col h-[550px] overflow-hidden">
                        <div class="p-3 border-b border-white/5 bg-white/[0.02]">
                            <h4 class="text-[10px] font-black text-white uppercase tracking-widest">Order Book</h4>
                        </div>
                        <div class="flex-1 overflow-hidden flex flex-col">
                            <!-- Asks (Sells) -->
                            <div class="flex-1 overflow-y-auto custom-scrollbar flex flex-col-reverse" id="orderbook-asks"></div>
                            
                            <!-- Spread / Mid Price -->
                            <div class="py-2 px-3 bg-white/5 border-y border-white/5 flex justify-between items-center text-xs">
                                <span class="font-black text-white" id="mid-price">0.00</span>
                                <span class="text-[9px] text-slate-500 font-bold">SPREAD 0.02%</span>
                            </div>

                            <!-- Bids (Buys) -->
                            <div class="flex-1 overflow-y-auto custom-scrollbar" id="orderbook-bids"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Tabs -->
                <div class="glass-card overflow-hidden">
                    <div class="flex border-b border-white/5 bg-white/[0.01]">
                        <button class="px-6 py-4 text-xs font-black text-cyan-400 border-b-2 border-cyan-500 bg-cyan-500/5 uppercase tracking-widest">Open Orders</button>
                        <button class="px-6 py-4 text-xs font-black text-slate-500 hover:text-slate-300 transition-colors uppercase tracking-widest">Filled History</button>
                    </div>
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left text-sm">
                            <thead class="text-slate-500 uppercase text-[9px] font-black tracking-widest bg-white/[0.01]">
                                <tr>
                                    <th class="px-6 py-4">Market</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4">Side</th>
                                    <th class="px-6 py-4 text-right">Price</th>
                                    <th class="px-6 py-4 text-right">Amount</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5" id="recent-orders-body">
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-white/[0.02] transition-colors border-l-2 {{ $order->side === 'buy' ? 'border-emerald-500/20' : 'border-rose-500/20' }}">
                                        <td class="px-6 py-4">
                                            <div class="text-xs font-black text-white uppercase">{{ $order->market->symbol }}</div>
                                            <div class="text-[9px] text-slate-600 font-bold">#{{ $order->id }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">{{ $order->type }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-black uppercase text-[10px] tracking-widest {{ $order->side === 'buy' ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $order->side }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-xs font-bold text-slate-300 font-mono">
                                            {{ number_format($order->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-xs font-bold text-slate-300 font-mono">
                                            {{ number_format($order->quantity, 4) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">Filled</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-600 text-[10px] font-black uppercase tracking-widest opacity-30">
                                            System Log: No Active Engagements
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Trading & Assets (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Trading Panel -->
                <div class="glass-card overflow-hidden">
                    <div class="p-4 border-b border-white/5 bg-white/[0.02] flex justify-between items-center">
                        <h3 class="font-bold text-white uppercase tracking-wider text-xs">Execute Trade</h3>
                        <div class="flex gap-2">
                            <span class="text-[10px] text-slate-500 font-bold uppercase">Mode:</span>
                            <span class="text-[10px] text-cyan-400 font-bold uppercase">Market</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('trade.store') }}" method="POST" id="trade-form">
                            @csrf
                            <div class="flex p-1 rounded-xl bg-slate-950/50 border border-white/5 mb-6">
                                <button type="button" onclick="setSide('buy')" id="buy-btn" class="flex-1 py-2.5 rounded-lg text-sm font-bold transition-all bg-emerald-500 text-white shadow-lg shadow-emerald-500/20">BUY</button>
                                <button type="button" onclick="setSide('sell')" id="sell-btn" class="flex-1 py-2.5 rounded-lg text-sm font-bold transition-all text-slate-500 hover:text-slate-300">SELL</button>
                                <input type="hidden" name="side" id="side-input" value="buy">
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1">Market Pair</label>
                                    <select name="market_id" id="market-select" class="w-full bg-slate-950/50 border-white/5 rounded-xl text-white font-bold focus:ring-cyan-500 focus:border-cyan-500 transition-all custom-scrollbar">
                                        @foreach ($markets as $market)
                                            <option value="{{ $market->id }}" data-price="{{ $market->last_price }}">{{ $market->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1">Quantity</label>
                                    <div class="relative group">
                                        <input type="number" step="0.0001" name="quantity" id="quantity-input" placeholder="0.00" class="w-full bg-slate-950/50 border-white/5 rounded-xl text-white font-bold focus:ring-cyan-500 focus:border-cyan-500 py-3 pl-4 pr-12 transition-all">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs font-bold" id="base-asset-label">BTC</span>
                                    </div>
                                </div>

                                <div class="p-4 rounded-xl bg-slate-950/30 border border-dashed border-white/10 space-y-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-slate-500 font-medium">Estimated Price</span>
                                        <span class="text-slate-300 font-bold" id="est-price">$0.00</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-slate-500 font-medium">Transaction Fee (0%)</span>
                                        <span class="text-emerald-500 font-bold">$0.00</span>
                                    </div>
                                    <div class="h-px bg-white/5 my-2"></div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-white font-bold">Total Cost</span>
                                        <span class="text-cyan-400 font-black" id="total-notional">$0.00</span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-black text-sm uppercase tracking-widest shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 hover:-translate-y-0.5 active:scale-95 transition-all">
                                    Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assets Card -->
                <div class="glass-card flex flex-col">
                    <div class="p-4 border-b border-white/5 bg-white/[0.02] flex justify-between items-center">
                        <h3 class="font-black text-white uppercase tracking-widest text-[10px]">Your Portfolio</h3>
                        <a href="{{ route('wallet.index') }}" class="text-[9px] text-cyan-400 font-bold uppercase transition-all hover:text-cyan-300">View Hub</a>
                    </div>

                    <!-- PnL Summary -->
                    @php $pnl = Auth::user()->dailyProfitLoss(); @endphp
                    <div class="px-6 py-4 bg-gradient-to-br {{ $pnl['amount'] >= 0 ? 'from-emerald-500/10' : 'from-rose-500/10' }} to-transparent border-b border-white/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">24h Performance</p>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-lg font-black {{ $pnl['amount'] >= 0 ? 'text-emerald-400' : 'text-rose-400' }} tracking-tighter">
                                        {{ $pnl['amount'] >= 0 ? '+' : '' }}{{ number_format($pnl['amount'], 2) }} <span class="text-xs uppercase">USD</span>
                                    </span>
                                    <span class="text-[10px] font-bold {{ $pnl['amount'] >= 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                                        ({{ number_format($pnl['percentage'], 2) }}%)
                                    </span>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $pnl['amount'] >= 0 ? 'text-emerald-500' : 'text-rose-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $pnl['amount'] >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 space-y-2 overflow-y-auto max-h-[400px] custom-scrollbar">
                        @foreach ($wallets as $wallet)
                            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-white/[0.03] transition-all border border-transparent hover:border-white/5 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center text-[10px] font-black text-slate-400 border border-white/10 uppercase group-hover:border-cyan-500/30 transition-colors">
                                        {{ $wallet->asset->symbol }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-black text-white uppercase">{{ $wallet->asset->name }}</span>
                                        <span class="text-[10px] text-slate-600 font-bold uppercase tracking-tight">{{ $wallet->asset->symbol }} Asset</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[11px] font-black text-white tracking-tight">{{ number_format($wallet->balance, $wallet->asset->symbol === 'USD' ? 2 : 6) }}</div>
                                    @if($wallet->locked_balance > 0)
                                        <div class="text-[8px] font-black text-amber-500/60 uppercase tracking-tighter">In Trade: {{ number_format($wallet->locked_balance, 2) }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ApexCharts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let chart;
        let activeMarketId = {{ $markets->first()->id }};

        function setSide(side) {
            const buyBtn = document.getElementById('buy-btn');
            const sellBtn = document.getElementById('sell-btn');
            const sideInput = document.getElementById('side-input');
            
            if (side === 'buy') {
                buyBtn.classList.add('bg-emerald-500', 'text-white', 'shadow-emerald-500/20');
                buyBtn.classList.remove('text-slate-500');
                sellBtn.classList.remove('bg-rose-500', 'text-white', 'shadow-rose-500/20');
                sellBtn.classList.add('text-slate-500');
                sideInput.value = 'buy';
            } else {
                sellBtn.classList.add('bg-rose-500', 'text-white', 'shadow-rose-500/20');
                sellBtn.classList.remove('text-slate-500');
                buyBtn.classList.remove('bg-emerald-500', 'text-white', 'shadow-emerald-500/20');
                buyBtn.classList.add('text-slate-500');
                sideInput.value = 'sell';
            }
        }

        function initChart(historyData) {
            const options = {
                series: [{ data: historyData }],
                chart: {
                    type: 'candlestick',
                    height: 480,
                    toolbar: { show: false },
                    background: 'transparent',
                    foreColor: '#64748b',
                    animations: { enabled: false }
                },
                grid: {
                    borderColor: 'rgba(255,255,255,0.03)',
                    xaxis: { lines: { show: true } }
                },
                xaxis: {
                    type: 'datetime',
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { fontSize: '10px', fontWeight: 700 } }
                },
                yaxis: {
                    opposite: true,
                    tooltip: { enabled: true },
                    labels: {
                        style: { fontSize: '10px', fontWeight: 700 },
                        formatter: val => val.toLocaleString('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 2 })
                    }
                },
                plotOptions: {
                    candlestick: {
                        colors: { upward: '#10b981', downward: '#f43f5e' },
                        wick: { useFillColor: true }
                    }
                },
                theme: { mode: 'dark' }
            };

            if (chart) chart.destroy();
            chart = new ApexCharts(document.querySelector("#main-chart"), options);
            chart.render();
        }

        function renderOrderBook(book) {
            const bidContainer = document.getElementById('orderbook-bids');
            const askContainer = document.getElementById('orderbook-asks');
            
            const maxQty = Math.max(...[...book.bids, ...book.asks].map(i => i.quantity));

            bidContainer.innerHTML = book.bids.map(bid => `
                <div class="relative flex justify-between px-3 py-1 text-[10px] group transition-colors hover:bg-emerald-500/5">
                    <div class="absolute inset-y-0 right-0 bg-emerald-500/10 transition-all duration-500" style="width: ${(bid.quantity / maxQty) * 100}%"></div>
                    <span class="relative z-10 font-bold text-emerald-400 font-mono">${bid.price.toFixed(4)}</span>
                    <span class="relative z-10 font-bold text-slate-400 font-mono">${bid.quantity.toFixed(4)}</span>
                </div>
            `).join('');

            askContainer.innerHTML = book.asks.map(ask => `
                <div class="relative flex justify-between px-3 py-1 text-[10px] group transition-colors hover:bg-rose-500/5">
                    <div class="absolute inset-y-0 right-0 bg-rose-500/10 transition-all duration-500" style="width: ${(ask.quantity / maxQty) * 100}%"></div>
                    <span class="relative z-10 font-bold text-rose-400 font-mono">${ask.price.toFixed(4)}</span>
                    <span class="relative z-10 font-bold text-slate-400 font-mono">${ask.quantity.toFixed(4)}</span>
                </div>
            `).join('');
        }

        async function refreshMarkets() {
            try {
                const response = await fetch("{{ route('markets.live') }}");
                const data = await response.json();

                data.markets.forEach((market) => {
                    // Update header tickers
                    const priceDisplays = document.querySelectorAll(`.market-price[data-id="${market.id}"]`);
                    priceDisplays.forEach(el => {
                        const oldPrice = parseFloat(el.innerText.replace(/,/g, ''));
                        el.innerText = Number(market.last_price).toLocaleString('en-US', {minimumFractionDigits: 2});
                        
                        // Price flash effect
                        if (market.last_price > oldPrice) {
                            el.parentElement.classList.add('border-emerald-500/30');
                            setTimeout(() => el.parentElement.classList.remove('border-emerald-500/30'), 800);
                        } else if (market.last_price < oldPrice) {
                            el.parentElement.classList.add('border-rose-500/30');
                            setTimeout(() => el.parentElement.classList.remove('border-rose-500/30'), 800);
                        }
                    });

                    // Update active pair chart & order book
                    if (market.id == activeMarketId) {
                        document.getElementById('mid-price').innerText = Number(market.last_price).toLocaleString('en-US', {minimumFractionDigits: 4});
                        document.getElementById('est-price').innerText = `$${Number(market.last_price).toLocaleString()}`;
                        
                        renderOrderBook(market.order_book);
                        
                        if (!chart) {
                            initChart(market.history);
                        } else {
                            // Smoothly update the last candle if needed, or re-render if market changed
                        }
                    }
                });

                updateNotional();
            } catch (e) { console.error("Terminal Link Failed", e); }
        }

        function updateNotional() {
            const qty = parseFloat(document.getElementById('quantity-input').value) || 0;
            const select = document.getElementById('market-select');
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption?.getAttribute('data-price')) || 0;
            
            const total = qty * price;
            document.getElementById('total-notional').innerText = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        }

        document.getElementById('market-select').addEventListener('change', (e) => {
            activeMarketId = e.target.value;
            const pair = e.target.options[e.target.selectedIndex].text;
            document.getElementById('active-pair-display').innerText = pair;
            document.getElementById('base-asset-label').innerText = pair.split('/')[0];
            
            chart = null; 
            refreshMarkets();
        });

        document.getElementById('quantity-input').addEventListener('input', updateNotional);

        // System Ignition
        refreshMarkets();
        setInterval(refreshMarkets, 3000);
    </script>
</x-app-layout>
