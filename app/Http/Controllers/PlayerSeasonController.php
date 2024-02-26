<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerSeasonController extends Controller
{
    public function index(PlayerSeason $playerSeason)
    {
        return inertia('Player/Index',
            [
                'players' => $playerSeason::with('user', 'guild')->get()
            ]);
    }

    public function store(Request $request)
    {
        PlayerSeason::create($request->all());

        return redirect()->route('player.index')
            ->with('success', 'Utworzono konto');
    }

    public function update(Request $request, PlayerSeason $playerSeason)
    {

        $validatedData = $request->validate([
            'name' => 'min:3|max:32|string',
            'damage' => 'required|integer|min:0'
        ]);

        $affected = $playerSeason->update($validatedData);

        if ($affected) {
            return redirect()->route('player.index')
                ->with('success', 'player has been updated.');
        } else {
            return dd($playerSeason);
        }
    }

    //Gracz został zaktualizowany.
    //Nie udało się zaktualizować gracza.

    public function edit(Request $request, $player_id)
    {
        $player = PlayerSeason::with('user', 'guild')->find($player_id);
        return inertia('Player/Edit',
            [
                'player' => $player
            ]);
    }
}

