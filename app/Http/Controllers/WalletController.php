<?php
 
namespace App\Http\Controllers;
 
use App\Models\Market;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $wallets = Wallet::with('asset')->where('user_id', $user->id)->get();
        $transactions = Transaction::with('asset')
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
        
        // Calculate estimated USD value
        $totalUsdValue = 0;
        $totalAvailableUsd = 0;
        $totalLockedUsd = 0;

        foreach ($wallets as $wallet) {
            $balance = (float) $wallet->balance;
            $locked = (float) $wallet->locked_balance;
            $market = null;

            if ($wallet->asset->symbol !== 'USD') {
                $market = Market::where('symbol', $wallet->asset->symbol . '/USD')->first();
            }

            $price = $market ? (float) $market->last_price : 1.0;

            $totalAvailableUsd += $balance * $price;
            $totalLockedUsd += $locked * $price;
            $totalUsdValue += ($balance + $locked) * $price;
        }

        return view('wallet.index', [
            'wallets' => $wallets,
            'transactions' => $transactions,
            'totalUsdValue' => $totalUsdValue,
            'totalAvailableUsd' => $totalAvailableUsd,
            'totalLockedUsd' => $totalLockedUsd
        ]);
    }

    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'amount' => 'required|numeric|gt:0',
            'method' => 'required|string|in:bank,crypto,manual',
            'reference_id' => 'nullable|string|max:255',
        ]);

        Transaction::create([
            'user_id' => $request->user()->id,
            'asset_id' => $validated['asset_id'],
            'amount' => $validated['amount'],
            'type' => 'deposit',
            'method' => $validated['method'],
            'reference_id' => $validated['reference_id'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Deposit request via ' . ucfirst($validated['method']) . ' submitted. Waiting for admin approval.');
    }

    public function withdraw(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'amount' => 'required|numeric|gt:0',
        ]);

        $wallet = Wallet::where('user_id', $request->user()->id)
            ->where('asset_id', $validated['asset_id'])
            ->first();

        if (!$wallet || $wallet->balance < $validated['amount']) {
            return back()->with('error', 'Insufficient funds for withdrawal.');
        }

        // Lock the balance immediately
        $wallet->decrement('balance', $validated['amount']);
        $wallet->increment('locked_balance', $validated['amount']);

        Transaction::create([
            'user_id' => $request->user()->id,
            'asset_id' => $validated['asset_id'],
            'amount' => $validated['amount'],
            'type' => 'withdrawal',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Withdrawal request submitted for review. Funds have been locked.');
    }
}
