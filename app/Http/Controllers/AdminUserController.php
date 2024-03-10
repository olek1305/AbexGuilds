<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function create()
    {
        return inertia('Admin/User/Create');
    }

    public function store(Request $request, User $user)
    {
        if (!auth()->user()->can('updateIsAdmin', $user)) {
            return redirect()->route('admin.index')
                ->with('error', 'Brak uprawnień do zmiany statusu administratora');
            // pozniej dodam do policy
            // jeśli jesteś moderatorem, nie możesz nadawać uprawnień administratora
        }

        $request->validate([
            'name' => ['required', 'string', Rule::unique('users')],
            'email' => 'nullable|email|unique:users',
            'password' => 'nullable',
            'is_admin' => 'boolean'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->is_admin = $request->filled('is_admin') ? $request->is_admin : false;

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
