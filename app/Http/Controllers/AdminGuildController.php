<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Guild;

class AdminGuildController extends Controller
{
    public function create()
    {
        return inertia('Admin/Guild/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $guild = new Guild();
        $guild->name = $request->name;
        $guild->save();

        return redirect()->route('admin.index')
            ->with('success', 'Gildia ' . $guild->name . ' została utworzona pomyślnie.');
    }

    public function listGuilds()
    {
        $guilds = Guild::all();
        return response()->json($guilds);
    }

    public function transferPlayer(Request $request, Player $player)
    {
        $request->validate([
            'guild_id' => 'required|integer|exists:guilds,id',
        ]);

        $targetGuild = Guild::findOrFail($request->guild_id);
    }
}
