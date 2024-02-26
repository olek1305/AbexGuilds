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

    public function update(Request $request, $player_id)
    {
        $playerSeason = PlayerSeason::findOrFail($player_id);

        $validatedData = $request->validate([
            'name' => 'min:3|max:32|string',
            'damage' => 'required|integer|min:0|max:100000000'
        ]);

        if (isset($validatedData['name'])) {
            $playerSeason->user()->update(['name' => $validatedData['name']]);
            unset($validatedData['name']);
        }

        $affected = $playerSeason->update($validatedData);

        return redirect()->route('player.index')
            ->with('success', 'Player has been updated.');
    }

    //Gracz został zaktualizowany.
    //Nie udało się zaktualizować gracza.

    public function edit(Request $request, $player_id)
    {
        $playerSeason = PlayerSeason::with('user', 'guild')->find($player_id);
        return inertia('Player/Edit',
            [
                'player' => $playerSeason
            ]);
    }
}

