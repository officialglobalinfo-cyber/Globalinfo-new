<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPrice extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'price', 'change', 'change_percent', 'day_high', 'day_low', 'volume', 'timestamp'];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
