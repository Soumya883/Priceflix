<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Market;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        foreach (Asset::all() as $asset) {
            Wallet::firstOrCreate(
                ['user_id' => $user->id, 'asset_id' => $asset->id],
                ['balance' => 0, 'locked_balance' => 0]
            );
        }

        $markets = Market::with(['baseAsset', 'quoteAsset'])
            ->where('is_active', true)
            ->orderBy('symbol')
            ->get();

        $wallets = $user->wallets()
            ->with('asset')
            ->orderByDesc('balance')
            ->get();

        $orders = Order::with('market')
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('markets', 'wallets', 'orders'));
    }
}
