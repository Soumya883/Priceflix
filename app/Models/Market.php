<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
{
    protected $fillable = [
        'symbol',
        'base_asset_id',
        'quote_asset_id',
        'last_price',
        'price_change_24h',
        'volume_24h',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'last_price' => 'decimal:8',
            'price_change_24h' => 'decimal:2',
            'volume_24h' => 'decimal:8',
            'is_active' => 'boolean',
        ];
    }

    public function baseAsset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'base_asset_id');
    }

    public function quoteAsset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'quote_asset_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
