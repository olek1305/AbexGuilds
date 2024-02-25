<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerSeasonController extends Controller
{
    public function index(PlayerSeason $playerseason)
    {
        return inertia('Player/Index',
            [
                'players' => $playerseason::with('user', 'guild')->get()
            ]);
    }

    public function store(Request $request)
    {
        PlayerSeason::create($request->all());

        return redirect()->route('player.index')
            ->with('success', 'Utworzono konto');
    }

    public function update(Request $request, PlayerSeason $playerseason)
    {
        $playerseason->update(
            $request->validate([
                'name' => 'required',
                'damage' => 'required|integer|min:0'
            ])
        );
        return redirect()->route('player.index')
            ->with('success', 'aktulizowano');
    }

    public function edit(Request $request, $player_id)
    {
        $player = PlayerSeason::with('user', 'guild')->find($player_id);
        return inertia('Player/Edit',
            [
                'player' => $player
            ])->with('success', 'aktulizowano');
    }
}

