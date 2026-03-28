<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->foreignId('base_asset_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('quote_asset_id')->constrained('assets')->cascadeOnDelete();
            $table->decimal('last_price', 20, 8)->default(0);
            $table->decimal('price_change_24h', 10, 2)->default(0);
            $table->decimal('volume_24h', 20, 8)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
