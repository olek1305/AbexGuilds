<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only([
            'name'
        ]);

        $players = PlayerSeason::with('guild', 'user')->get()->map(function ($player) {
            $player->activities = json_decode($player->activities, true);
            return $player;
        });

        $guilds = Guild::query()->filter($filters)->get();

        return Inertia::render('Activity/Index', [
            'players' => $players,
            'guilds' => $guilds,
        ]);
    }

    public function update(Request $request, $id)
    {
        $player = PlayerSeason::findOrFail($id);

        $player->activities = $request->input('activities');

        $player->save();

        return redirect()->back();
    }
}
