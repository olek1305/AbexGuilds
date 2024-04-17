<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        $latestSeasonId = PlayerSeason::latest('id')->value('season');

        return Inertia::render('Admin/Index', [
            'latestSeasonId' => $latestSeasonId
        ]);
    }
}
