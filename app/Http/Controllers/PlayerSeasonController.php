<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;


class PlayerSeasonController extends Controller
{
    public function index(Request $request): Response|ResponseFactory
    {
        $user = Auth::user();
        $isAdminUser = ['is_admin' => $user->is_admin];

        $filters = $request->only([
           'guild_id', 'damageFrom', 'damageTo', 'season'
        ]);

        $guilds = Guild::all();

        $seasons = PlayerSeason::distinct()->pluck('season');

        $players = PlayerSeason::query()
            ->with('user', 'guild')
            ->whereHas('user', function($query) {
                $query->whereNull('deleted_at');
            })
            ->latestGuildId()
            ->firstIsObserver()
            ->latestIsStar()
            ->latestDamage()
            ->filter($filters)
            ->paginate(70)
            ->withQueryString();

        return Inertia::render('Player/Index',
            [
                'players' => $players,
                'filters' => $filters,
                'guilds' => $guilds,
                'seasons' => $seasons,
                'isAdminUser' => $isAdminUser
            ]);
    }

    public function create(PlayerSeason $player): Response|ResponseFactory
    {
        $users = User::all();
        $guilds = Guild::all();
        return Inertia::render('Player/Create', [
            'player' => $player,
            'users' => $users,
            'guilds' => $guilds
        ]);
    }

    public function store(Request $request): RedirectResponse
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

    public function update(Request $request, PlayerSeason $player): RedirectResponse
    {
        if (!auth()->user()->can('update', $player)) {
            abort(403);
        }

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

    public function edit($player_id): Response|ResponseFactory
    {
        $playerSeason = PlayerSeason::with('user', 'guild')->find($player_id);
        return Inertia::render('Player/Edit',
            [
                'player' => $playerSeason
            ]);
    }

    public function destroy(PlayerSeason $player): RedirectResponse
    {
        $player->deleteOrFail();
        return redirect()->route('player.index')
            ->with('success', 'Gracz: zostal usuniety');
    }

    public function transfer(Request $request, PlayerSeason $player): RedirectResponse
    {
        $request->validate([
            'guild_id' => 'required|exists:guilds,id'
        ]);

        $player->update([
            'guild_id' => $request->guild_id
        ]);

        return redirect()->route('player.index')
            ->with('success', 'Gracz został przeniesiony do innej gildii');
    }
}

