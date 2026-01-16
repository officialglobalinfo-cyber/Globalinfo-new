<?php

namespace App\Jobs;

use App\Models\Stock;
use App\Models\StockPrice;
use App\Services\MarketService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMarketDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(MarketService $marketService): void
    {
        $stocks = Stock::where('is_active', true)->get();

        foreach ($stocks as $stock) {
            $data = $marketService->fetchStockPrice($stock->symbol);
            
            if ($data) {
                StockPrice::create([
                    'stock_id' => $stock->id,
                    'price' => $data['price'],
                    'change' => $data['change'],
                    'change_percent' => $data['change_percent'],
                    'volume' => $data['volume'],
                ]);
            }
        }
    }
}
