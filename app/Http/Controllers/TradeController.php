<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Order;
use App\Models\Trade;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TradeController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'market_id' => ['required', 'integer', Rule::exists('markets', 'id')],
            'side' => ['required', Rule::in(['buy', 'sell'])],
            'quantity' => ['required', 'numeric', 'gt:0'],
        ]);

        $user = $request->user();
        $market = Market::with(['baseAsset', 'quoteAsset'])->findOrFail($validated['market_id']);

        $price = (float) $market->last_price;
        $quantity = (float) $validated['quantity'];
        $notional = $price * $quantity;

        if ($quantity <= 0 || $price <= 0) {
            return back()->with('error', 'Invalid market or quantity.');
        }

        return DB::transaction(function () use ($user, $market, $validated, $quantity, $notional, $price) {
            $baseWallet = Wallet::firstOrCreate(
                ['user_id' => $user->id, 'asset_id' => $market->base_asset_id],
                ['balance' => 0, 'locked_balance' => 0]
            );
            $quoteWallet = Wallet::firstOrCreate(
                ['user_id' => $user->id, 'asset_id' => $market->quote_asset_id],
                ['balance' => 0, 'locked_balance' => 0]
            );

            // Re-fetch with lock for update
            $baseWallet = Wallet::where('id', $baseWallet->id)->lockForUpdate()->first();
            $quoteWallet = Wallet::where('id', $quoteWallet->id)->lockForUpdate()->first();

            if ($validated['side'] === 'buy') {
                if ((float) $quoteWallet->balance < $notional) {
                    return back()->with('error', 'Insufficient funds. Available ' . $market->quoteAsset->symbol . ': ' . number_format($quoteWallet->balance, 2));
                }

                $quoteWallet->decrement('balance', $notional);
                $baseWallet->increment('balance', $quantity);
            } else {
                if ((float) $baseWallet->balance < $quantity) {
                    return back()->with('error', 'Insufficient asset quantity. Available ' . $market->baseAsset->symbol . ': ' . number_format($baseWallet->balance, 8));
                }

                $baseWallet->decrement('balance', $quantity);
                $quoteWallet->increment('balance', $notional);
            }

            $order = Order::create([
                'user_id' => $user->id,
                'market_id' => $market->id,
                'side' => $validated['side'],
                'type' => 'market',
                'price' => $price,
                'quantity' => $quantity,
                'filled_quantity' => $quantity,
                'status' => 'filled',
            ]);

            Trade::create([
                'order_id' => $order->id,
                'market_id' => $market->id,
                'price' => $price,
                'quantity' => $quantity,
                'notional' => $notional,
            ]);

            return back()->with('success', 'Market order for ' . number_format($quantity, 4) . ' ' . $market->baseAsset->symbol . ' filled at ' . number_format($price, 2) . ' USD.');
        });
    }
}
