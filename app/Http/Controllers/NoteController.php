<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(PlayerSeason $player)
    {
        return inertia('Note/Index',
            [
                'notes' => $player::with('user', 'note')->latest('id')->get()
            ]);
    }
}
