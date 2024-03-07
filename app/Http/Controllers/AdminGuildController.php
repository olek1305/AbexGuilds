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
}
