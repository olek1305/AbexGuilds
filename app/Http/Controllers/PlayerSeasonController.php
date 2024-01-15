<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerSeasonController extends Controller
{
    public function index()
    {
        return inertia('Player/Index',
            [
                'players' => PlayerSeason::with('user', 'guild')->get(),
            ]);
    }

    public function show($user_id)
    {
        return inertia('Player/Show',
            [
                'user' => User::find($user_id),
                'player' => Player::where('user_id', $user_id)->first(),
            ]);
    }

    public function update(\http\Env\Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $this->authorize('update', $player);
        $player->update([
            'damage' => $request->input('damage'),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('players.index');
    }
}

