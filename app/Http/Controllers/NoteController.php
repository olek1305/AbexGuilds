<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('id', 'desc')->paginate(10);
        return inertia('Note/Index',
            [
                'notes' => $notes
            ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $notes = $user->notes()->paginate(10);
        return inertia('Note/Show', [
            'user' => $user,
            'notes' => $notes,
        ]);
    }

    public function create()
    {
        $users = User::all();

        return inertia('Note/Create', [
            'users' => $users
        ]);
    }

    public function store(Request $request, PlayerSeason $player)
    {
        if (!auth()->user()->can('update', $player)) {
            abort(403);
        }

        Note::create($request->validate([
            'user_id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required|string|max:255'
        ]));

        return redirect()->route('notes.index')
            ->with('success', 'Stworzony notatnik');
    }

    public function edit(Note $note)
    {
        return Inertia('Note/Edit', [
            'note' => $note
        ]);
    }

    public function update(Note $note, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $note->update($validatedData);

        return redirect()->route('notes.index')->with('success', 'Note updated!');
    }

    public function destroy(Note $note)
    {
        $note->deleteOrFail();
        return redirect()->route('notes.index')
            ->with('error', 'Notatnik ID:' . $note->id . 'zostal usuniety');
    }
}
