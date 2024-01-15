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
        Schema::create('player_seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('season_id');
            $table->integer('damage')->default(0);
            $table->boolean('is_observer')->default(false);
            $table->boolean('is_star')->default(false);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('guild_id');
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('users');
            $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_seasons');
    }
};
