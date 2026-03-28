<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Trade;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $orders = Order::with('market')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        $trades = Trade::with('market')
            ->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->paginate(15);

        return view('history.index', compact('orders', 'trades'));
    }
}
