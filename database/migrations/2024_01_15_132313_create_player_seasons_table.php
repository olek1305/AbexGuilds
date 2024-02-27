<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerSeasonsTable extends Migration
{
    public function up(): void
    {
        Schema::create('player_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'player_id')->constrained('users');
            $table->unsignedBigInteger('season_id');
            $table->integer('damage')->default(0);
            $table->boolean('is_observer')->default(false);
            $table->boolean('is_star')->default(false);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreignId('guild_id')->constrained('guilds');
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_seasons');
    }
}
