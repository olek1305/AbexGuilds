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
        Schema::table('player_seasons', function (Blueprint $table) {
//            $table->json('activities')->default('{"Saturday":0, "Sunday":0, "Monday":0, "Tuesday":0, "Wednesday":0, "FailFarm":0, "Complete":0}');
            $table->json('activities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('player_seasons', function (Blueprint $table) {
            //
        });
    }
};
