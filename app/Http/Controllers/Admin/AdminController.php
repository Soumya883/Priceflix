<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'admins' => User::where('is_admin', true)->count(),
            'markets' => Market::count(),
            'orders' => Order::count(),
            'pending_orders' => Order::where('status', 'open')->count(),
            'total_volume' => (float) Order::sum('filled_quantity'),
        ];

        $users = User::with('wallets.asset')->latest()->paginate(20);
        $recentOrders = Order::with(['user', 'market'])->latest()->take(10)->get();
        $pendingTransactions = Transaction::with(['user', 'asset'])->where('status', 'pending')->latest()->get();

        return view('admin.index', compact('stats', 'users', 'recentOrders', 'pendingTransactions'));
    }

    public function toggleAdmin(User $user)
    {
        // Prevent self-demotion
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot change your own admin status.');
        }

        $user->update(['is_admin' => !$user->is_admin]);

        return back()->with('success', "Admin status updated for {$user->name}.");
    }

    public function approveTransaction(Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'This transaction has already been processed.');
        }

        DB::transaction(function () use ($transaction) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $transaction->user_id, 'asset_id' => $transaction->asset_id],
                ['balance' => 0, 'locked_balance' => 0]
            );

            if ($transaction->type === 'deposit') {
                $wallet->increment('balance', (float) $transaction->amount);
            } elseif ($transaction->type === 'withdrawal') {
                // Funds are already moved to locked_balance in WalletController@withdraw
                if ($wallet->locked_balance < $transaction->amount) {
                    throw new \Exception('Insufficient locked balance to approve withdrawal.');
                }
                $wallet->decrement('locked_balance', (float) $transaction->amount);
            }

            $transaction->update([
                'status' => 'approved',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
            ]);
        });

        return back()->with('success', 'Transaction approved successfully.');
    }

    public function rejectTransaction(Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'This transaction has already been processed.');
        }

        DB::transaction(function () use ($transaction) {
            if ($transaction->type === 'withdrawal') {
                $wallet = Wallet::where('user_id', $transaction->user_id)
                    ->where('asset_id', $transaction->asset_id)
                    ->first();
                
                if ($wallet) {
                    $wallet->increment('balance', (float) $transaction->amount);
                    $wallet->decrement('locked_balance', (float) $transaction->amount);
                }
            }

            $transaction->update([
                'status' => 'rejected',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
            ]);
        });

        return back()->with('success', 'Transaction rejected and funds (if any) returned.');
    }

    public function sendMoney(User $user, Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'amount' => 'required|numeric|gt:0',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $user->id, 'asset_id' => $validated['asset_id']],
                ['balance' => 0, 'locked_balance' => 0]
            );

            $wallet->increment('balance', (float) $validated['amount']);

            Transaction::create([
                'user_id' => $user->id,
                'asset_id' => $validated['asset_id'],
                'amount' => $validated['amount'],
                'type' => 'adjustment',
                'status' => 'approved',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
                'notes' => $validated['notes'] ?? 'Admin manual credit',
            ]);
        });

        return back()->with('success', "Credit of {$validated['amount']} processed for {$user->name}.");
    }
}
