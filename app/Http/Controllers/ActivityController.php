<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActivityController extends Controller
{
    public function index(): Response
    {
        $guilds = Guild::all();

        return Inertia::render('Activity/Index',
            [
                'guilds' => $guilds,
            ]
        );
    }

    public function show($id): Response
    {
        $latestSeasonId = PlayerSeason::latest('id')->value('season');

        $players = PlayerSeason::with('guild', 'user')
            ->where('guild_id', $id)
            ->where('season', $latestSeasonId)
            ->latest('id')
            ->get()
            ->map(function ($player) use ($latestSeasonId) {
                $player->activities = json_decode($player->activities, true);
                $player->latestSeasonId = $latestSeasonId;
                return $player;
            });

        return Inertia::render('Activity/Show', [
            'players' => $players,
        ]);
    }



    public function update(Request $request, $id): RedirectResponse
    {
        $player = PlayerSeason::findOrFail($id);

        $player->activities = $request->input('activities');

        $player->save();

        return redirect()->back();
    }
}
