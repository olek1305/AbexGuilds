<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        $latestSeasonId = PlayerSeason::latest('id')->value('season');

        $guilds = Guild::leftJoin('player_seasons', 'guilds.id', '=', 'player_seasons.guild_id')
            ->where('player_seasons.season', $latestSeasonId)
            ->select('guilds.id', 'guilds.name', DB::raw('count(player_seasons.id) as players_count'))
            ->groupBy('guilds.id', 'guilds.name')
            ->get();

        return Inertia::render('Admin/Index', [
            'guilds' => $guilds,
            'latestSeasonId' => $latestSeasonId
        ]);
    }
}
