<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketScore extends Model
{
    use HasFactory;

    protected $fillable = ['match_id', 'home_score', 'away_score', 'status_text', 'raw_data'];

    protected $casts = [
        'raw_data' => 'array',
    ];

    public function match()
    {
        return $this->belongsTo(CricketMatch::class, 'match_id');
    }
}
