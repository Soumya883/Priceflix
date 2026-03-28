<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\JsonResponse;

class MarketDataController extends Controller
{
    public function index(): JsonResponse
    {
        $markets = Market::with(['baseAsset', 'quoteAsset'])
            ->where('is_active', true)
            ->get();

        $processedMarkets = $markets->map(function (Market $market) {
            $delta = mt_rand(-15, 15) / 1000;
            if ($market->symbol === 'BTC/USD') $delta = mt_rand(-5, 5) / 1000;
            
            $lastPrice = max(0.0001, (float) $market->last_price * (1 + $delta));
            $change24h = (float) $market->price_change_24h + ($delta * 10);
            
            $market->update([
                'last_price' => $lastPrice,
                'price_change_24h' => $change24h,
            ]);

            // Generate Mock Order Book
            $bids = [];
            $asks = [];
            for ($i = 0; $i < 10; $i++) {
                $bids[] = [
                    'price' => round($lastPrice * (1 - (mt_rand(1, 50) / 10000)), 4),
                    'quantity' => mt_rand(1, 400) / 100,
                ];
                $asks[] = [
                    'price' => round($lastPrice * (1 + (mt_rand(1, 50) / 10000)), 4),
                    'quantity' => mt_rand(1, 400) / 100,
                ];
            }
            usort($bids, fn($a, $b) => $b['price'] <=> $a['price']);
            usort($asks, fn($a, $b) => $a['price'] <=> $b['price']);

            // Historical Data
            $history = [];
            $currPrice = $lastPrice;
            $now = now();
            for ($i = 60; $i >= 0; $i--) {
                $open = $currPrice * (1 + (mt_rand(-10, 10) / 1000));
                $close = $currPrice;
                $high = max($open, $close) * (1 + (mt_rand(0, 5) / 1000));
                $low = min($open, $close) * (1 - (mt_rand(0, 5) / 1000));
                
                $history[] = [
                    'x' => $now->copy()->subMinutes($i)->getTimestampMs(),
                    'y' => [round($open, 4), round($high, 4), round($low, 4), round($close, 4)]
                ];
                $currPrice = $open;
            }

            return [
                'id' => $market->id,
                'symbol' => $market->symbol,
                'last_price' => round($lastPrice, 4),
                'price_change_24h' => round($change24h, 2),
                'order_book' => [
                    'bids' => $bids,
                    'asks' => $asks,
                ],
                'history' => $history,
            ];
        });

        return response()->json([
            'timestamp' => now()->toDateTimeString(),
            'markets' => $processedMarkets,
        ]);
    }
}
