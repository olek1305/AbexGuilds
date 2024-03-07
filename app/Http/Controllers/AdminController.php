<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $latestSeasonId = PlayerSeason::latest('id')->value('season');

        $guilds = Guild::leftJoin('player_seasons', 'guilds.id', '=', 'player_seasons.guild_id')
            ->where('player_seasons.season', $latestSeasonId)
            ->select('guilds.id', 'guilds.name', DB::raw('count(player_seasons.id) as players_count'))
            ->groupBy('guilds.id', 'guilds.name')
            ->get();

        return inertia('Admin/Index', [
            'guilds' => $guilds,
            'latestSeasonId' => $latestSeasonId
        ]);
    }


    public function destroy(User $user)
    {
        $user->deleteOrFail();

        return redirect()->back()
            ->with('success', 'User został usunięty!');
    }

    public function restore(User $user) {
        $user->restore();

        return redirect()->back()->with('success', 'User został przywrócony!');
    }
}
