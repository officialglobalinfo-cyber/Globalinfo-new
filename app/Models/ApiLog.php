<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',
        'endpoint',
        'payload',
        'status_code',
        'error_message',
        'duration_ms'
    ];
}
