<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->string('name');
            $table->string('exchange')->default('NSE'); // NSE, BSE, NASDAQ
            $table->string('type')->default('equity'); // equity, index, crypto
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('stock_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->decimal('change', 10, 2)->nullable();
            $table->decimal('change_percent', 8, 2)->nullable();
            $table->decimal('day_high', 10, 2)->nullable();
            $table->decimal('day_low', 10, 2)->nullable();
            $table->bigInteger('volume')->nullable();
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_prices');
        Schema::dropIfExists('stocks');
    }
};
