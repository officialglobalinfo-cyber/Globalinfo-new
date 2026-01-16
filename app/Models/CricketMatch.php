<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketMatch extends Model
{
    use HasFactory;

    protected $fillable = ['external_id', 'series_name', 'team_home', 'team_away', 'status', 'match_time', 'venue', 'result'];

    protected $casts = [
        'match_time' => 'datetime',
    ];

    public function scores()
    {
        return $this->hasMany(CricketScore::class, 'match_id');
    }
    
    public function latestScore()
    {
        return $this->hasOne(CricketScore::class, 'match_id')->latestOfMany();
    }
}
