<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Market;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $usd = Asset::firstOrCreate(['symbol' => 'USD'], ['name' => 'US Dollar', 'precision' => 2, 'is_fiat' => true]);
        $btc = Asset::firstOrCreate(['symbol' => 'BTC'], ['name' => 'Bitcoin', 'precision' => 8, 'is_fiat' => false]);
        $eth = Asset::firstOrCreate(['symbol' => 'ETH'], ['name' => 'Ethereum', 'precision' => 8, 'is_fiat' => false]);
        $sol = Asset::firstOrCreate(['symbol' => 'SOL'], ['name' => 'Solana', 'precision' => 8, 'is_fiat' => false]);
        $matic = Asset::firstOrCreate(['symbol' => 'MATIC'], ['name' => 'Polygon', 'precision' => 8, 'is_fiat' => false]);
        $pepe = Asset::firstOrCreate(['symbol' => 'PEPE'], ['name' => 'Pepe Coin', 'precision' => 0, 'is_fiat' => false]);
        $arb = Asset::firstOrCreate(['symbol' => 'ARB'], ['name' => 'Arbitrum', 'precision' => 8, 'is_fiat' => false]);

        $markets = [
            ['symbol' => 'BTC/USD', 'base' => $btc, 'price' => 67420.50, 'change' => 2.4],
            ['symbol' => 'ETH/USD', 'base' => $eth, 'price' => 3450.12, 'change' => -1.2],
            ['symbol' => 'SOL/USD', 'base' => $sol, 'price' => 184.50, 'change' => 5.7],
            ['symbol' => 'MATIC/USD', 'base' => $matic, 'price' => 0.68, 'change' => -0.4],
            ['symbol' => 'PEPE/USD', 'base' => $pepe, 'price' => 0.00000842, 'change' => 12.5],
            ['symbol' => 'ARB/USD', 'base' => $arb, 'price' => 1.12, 'change' => 1.8],
        ];

        foreach ($markets as $m) {
            Market::firstOrCreate(
                ['symbol' => $m['symbol']],
                [
                    'base_asset_id' => $m['base']->id,
                    'quote_asset_id' => $usd->id,
                    'last_price' => $m['price'],
                    'price_change_24h' => $m['change'],
                    'volume_24h' => mt_rand(1000, 100000) / 10
                ]
            );
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@exchange.test'],
            ['name' => 'Admin Trader', 'password' => bcrypt('password'), 'is_admin' => true]
        );

        $user = User::firstOrCreate(
            ['email' => 'demo@exchange.test'],
            ['name' => 'Demo Trader', 'password' => bcrypt('password'), 'is_admin' => false]
        );

        foreach ([$admin, $user] as $account) {
            foreach (Asset::all() as $asset) {
                $balance = match($asset->symbol) {
                    'USD' => 100000.00,
                    'BTC' => 1.5,
                    'ETH' => 15.0,
                    'SOL' => 50.0,
                    default => 1000.0
                };

                Wallet::firstOrCreate(
                    ['user_id' => $account->id, 'asset_id' => $asset->id],
                    ['balance' => $balance, 'locked_balance' => 0]
                );
            }
        }
    }
}
