<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
//    public function index(Request $request)
//    {
////        $notes = $user->note()->with('user_id')->latest('id')->paginate(10);
////        $notes = Note::orderBy('id', 'desc')->paginate(10);
//
//        $user = $request->user();
//        $notes = $user->notes()->latest('id')->paginate(10);
//
//        return inertia('Note/Index',
//            [
//                'notes' => $notes
//            ]);
//    }

    public function index()
    {
        $notes = Note::orderBy('id', 'desc')->paginate(10);
        return inertia('Note/Index',
            [
                'notes' => $notes
            ]);
    }
}