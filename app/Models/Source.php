<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'api_key_ref', 'type', 'priority', 'is_active'];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
