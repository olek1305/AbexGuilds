<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerSeasonController extends Controller
{
    public function index(PlayerSeason $player)
    {
        return inertia('Player/Index',
            [
                'players' => $player::with('user', 'guild')->get()
            ]);
    }

    public function store(Request $request)
    {
        PlayerSeason::create($request->all());

        return redirect()->route('player.index')
            ->with('success', 'Utworzono konto');
    }

//    public function update(Request $request, $player_id)
//    {
//        $playerSeason = PlayerSeason::findOrFail($player_id);
//
//        $validatedData = $request->validate([
//            'name' => 'min:3|max:32|string',
//            'is_observer' => 'required|boolean',
//            'is_star' => 'required|boolean',
//            'damage' => 'required|integer|min:0|max:100000000'
//        ]);
//
//        if (isset($validatedData['name'])) {
//            $playerSeason->user()->update(['name' => $validatedData['name']]);
//            unset($validatedData['name']);
//        }
//
//        $affected = $playerSeason->update($validatedData);
//
//        return redirect()->route('player.index')
//            ->with('success', 'Gracz został zaktualizowany');
//    }

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
            ->with('error', 'gracz zostal usuniety');
    }
}

