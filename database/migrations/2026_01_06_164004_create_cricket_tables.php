<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cricket_matches', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique()->nullable(); // API Match ID
            $table->string('series_name')->nullable();
            $table->string('team_home');
            $table->string('team_away');
            $table->string('status')->default('upcoming'); // upcoming, live, completed
            $table->timestamp('match_time')->nullable();
            $table->string('venue')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();
        });

        Schema::create('cricket_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('cricket_matches')->cascadeOnDelete();
            $table->string('home_score')->nullable();
            $table->string('away_score')->nullable();
            $table->string('status_text')->nullable(); // e.g., "Innings Break"
            $table->json('raw_data')->nullable(); // Store full JSON from API for details
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cricket_scores');
        Schema::dropIfExists('cricket_matches');
    }
};
