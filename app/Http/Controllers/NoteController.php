<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class NoteController extends Controller
{
    public function index(): Response
    {
        $notes = Note::with('user')->orderBy('id', 'desc')->paginate(10);

        return Inertia::render('Note/Index',
            [
                'notes' => $notes,

            ]);
    }

    public function show($id): Response|ResponseFactory
    {
        $user = User::findOrFail($id);
        $notes = $user->notes()->paginate(10);
        return Inertia::render('Note/Show', [
            'user' => $user,
            'notes' => $notes,
        ]);
    }

    public function create(): Response
    {
        $users = User::all();

        return Inertia::render('Note/Create', [
            'users' => $users
        ]);
    }

    public function store(Request $request, PlayerSeason $player): RedirectResponse
    {
        if (!auth()->user()->can('update', $player)) {
            abort(403);
        }

        $note = Note::create($request->validate([
            'user_id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required|string|max:255',
            'signature' => 'string'
        ]));

        $user = auth()->user();
        $note->signature = $note->signature ? $note->signature . "\n" . $user->name : $user->name;
        $note->save();

        return redirect()->route('notes.index')
            ->with('success', 'Stworzony notatnik');
    }

    public function edit(Note $note): Response
    {
        return Inertia::render('Note/Edit', [
            'note' => $note
        ]);
    }

    public function update(Note $note, Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'signature' => 'string'
        ]);

        $user = auth()->user();
        $note->signature = $note->signature ? $note->signature . "\n" . $user->name : $user->name;
        $note->update($validatedData);

        return redirect()->route('notes.index')->with('success', 'Note updated!');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->deleteOrFail();
        return redirect()->route('notes.index')
            ->with('success', 'Notatnik ID:' . $note->id . 'zostal usuniety');
    }
}
