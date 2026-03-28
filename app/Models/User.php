<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'is_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function totalUsdBalance(): float
    {
        $totalUsd = 0;
        $wallets = $this->wallets()->with('asset')->get();
        
        foreach ($wallets as $wallet) {
            $balance = (float) $wallet->balance + (float) $wallet->locked_balance;
            if ($wallet->asset->symbol === 'USD') {
                $totalUsd += $balance;
            } else {
                $market = Market::where('symbol', $wallet->asset->symbol . '/USD')->first();
                if ($market) {
                    $totalUsd += $balance * (float) $market->last_price;
                }
            }
        }
        
        return $totalUsd;
    }

    public function dailyProfitLoss(): array
    {
        $wallets = $this->wallets()->with('asset')->get();
        $totalPnl = 0;
        
        foreach ($wallets as $wallet) {
            if ($wallet->asset->symbol !== 'USD') {
                $market = Market::where('symbol', $wallet->asset->symbol . '/USD')->first();
                if ($market) {
                    $change = (float) $market->price_change_24h;
                    $value = (float) $wallet->balance * (float) $market->last_price;
                    // Daily PnL estimate: Value * (Change% / (100 + Change%))
                    $totalPnl += $value * ($change / 100);
                }
            }
        }
        
        return [
            'amount' => $totalPnl,
            'percentage' => $this->totalUsdBalance() > 0 ? ($totalPnl / $this->totalUsdBalance()) * 100 : 0
        ];
    }
}
