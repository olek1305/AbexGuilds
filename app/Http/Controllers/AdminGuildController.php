<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Guild;
use Inertia\Inertia;
use Inertia\Response;

class AdminGuildController extends Controller
{
    public function create(): Response
    {
        return inertia::render('Admin/Guild/Create');
    }

    public function store(Request $request): RedirectResponse
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

    public function transferPlayer(Request $request): void
    {
        $request->validate([
            'guild_id' => 'required|integer|exists:guilds,id',
        ]);

        Guild::findOrFail($request->guild_id);
    }
}
