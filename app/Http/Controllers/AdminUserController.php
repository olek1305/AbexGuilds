<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function create()
    {
        return inertia('Admin/User/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|password'
        ]);

        $user = new User();
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        } else {
            $randomPassword = Str::random(10);
            $user->password = Hash::make($randomPassword);

            // Informuj użytkownika o wygenerowanym haśle
            $request->session()->flash('random_password', $randomPassword);
        }

        $user->save();

        return redirect()->route('admin.index')
            ->with('success', 'User ' . $user->name . ' został utworzony.');
    }
}
