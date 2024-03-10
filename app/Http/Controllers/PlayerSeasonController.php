<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;


class PlayerSeasonController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only([
           'guild_id', 'damageFrom', 'damageTo', 'season'
        ]);

        $guilds = Guild::all();

        $seasons = PlayerSeason::distinct()->pluck('season');

        $players = PlayerSeason::query()
            ->with('user', 'guild')
            ->latestGuildId()
            ->firstIsObserver()
            ->latestIsStar()
            ->latestDamage()
            ->filter($filters)
            ->paginate(70)
            ->withQueryString();

        return inertia('Player/Index',
            [
                'players' => $players,
                'filters' => $filters,
                'guilds' => $guilds,
                'seasons' => $seasons,
            ]);
    }

    public function create(PlayerSeason $player)
    {
        $users = User::all();
        $guilds = Guild::all();
        return inertia('Player/Create', [
            'player' => $player,
            'users' => $users,
            'guilds' => $guilds
        ]);
    }

    public function store(Request $request)
    {
        PlayerSeason::create($request->validate([
            'player_id' => 'required',
            'damage' => 'nullable',
            'is_star' => 'nullable',
            'is_observer' => 'nullable',
            'season' => 'required|integer',
            'guild_id' => 'required'
        ]));

        return redirect()->route('player.index')
            ->with('success', 'Stworzony player');
    }

    public function update(Request $request, PlayerSeason $player)
    {
        $player->update(
            $request->validate([
                'damage' => 'required|integer|min:0',
                'is_star' => 'boolean',
                'is_observer' => 'boolean',
            ])
        );
        return redirect()->route('player.index')
            ->with('success', 'gracz zaktualizowany');
    }

    public function edit(Request $request, $player_id)
    {
        $playerSeason = PlayerSeason::with('user', 'guild')->find($player_id);
        return inertia('Player/Edit',
            [
                'player' => $playerSeason
            ]);
    }

    public function destroy(PlayerSeason $player)
    {
        $player->deleteOrFail();
        return redirect()->route('player.index')
            ->with('error', 'Gracz: ' . $player->user->name  . ' zostal usuniety');
    }
}

