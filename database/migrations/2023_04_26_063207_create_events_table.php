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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('minute');
            $table->enum('type', ['gól', 'öngól', 'sárga lap', 'piros lap']);
            $table->timestamps();
            
            $table->unsignedBigInteger('game_id')->nullable();
            $table->unsignedBigInteger('player_id')->nullable();

            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
