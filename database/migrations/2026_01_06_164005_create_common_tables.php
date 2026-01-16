<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('service'); // GNews, AlphaVantage, etc.
            $table->string('endpoint');
            $table->text('payload')->nullable();
            $table->integer('status_code')->nullable();
            $table->text('error_message')->nullable();
            $table->integer('duration_ms')->nullable();
            $table->timestamps();
        });
        
        Schema::create('media', function (Blueprint $table) {
             $table->id();
             $table->string('file_name');
             $table->string('file_path');
             $table->string('mime_type')->nullable();
             $table->unsignedBigInteger('size')->nullable();
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('api_logs');
    }
};
