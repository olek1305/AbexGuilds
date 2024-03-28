<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\Note;
use App\Models\PlayerSeason;
use App\Models\Stats;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StatsController extends Controller
{
    public function index(Request $request, $season = null): Response
    {
        $guilds = Guild::with([
            'players' => function($query) use ($season) {
                $query->where('season', $season);
            }
        ])->get();

        if ($guilds->isEmpty()) {
            return Inertia::render('Stats/Index', [
                'guilds' => [],
                'seasons' => PlayerSeason::distinct()->pluck('season'),
                'selectedSeason' => $season,
            ]);
        }

        $guilds = $guilds->map(function($guild) {
            $guild->total_damage = $guild->players->sum('damage');
            $guild->player_stars = $guild->players->sum('is_star');
            $guild->player_observer = $guild->players->sum('is_observer');
            $guild->player_count = $guild->players->count();
            return $guild;
        });

        $notes = Note::all();
        $totalNotes = $notes->count();

        return Inertia::render('Stats/Index', [
            'guilds' => $guilds,
            'seasons' => PlayerSeason::distinct()->pluck('season'),
            'selectedSeason' => (int) $season,
            'total_notes' => $totalNotes
        ]);
    }
}
