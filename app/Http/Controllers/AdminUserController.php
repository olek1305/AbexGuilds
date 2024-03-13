<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function list()
    {
        $users = User::select(['id', 'name'])->get(); // Wybierz tylko niezbędne kolumny
        return inertia('Admin/User/List',
            [
                'users' => $users
            ]);
    }

    public function create()
    {
        return inertia('Admin/User/Create');
    }

    public function store(Request $request, User $user)
    {
        if (!auth()->user()->can('updateIsAdmin', $user)) {
            return redirect()->route('admin.index')
                ->with('error', 'Brak uprawnień do zmiany statusu administratora');
        }

        $request->validate([
            'name' => ['required', 'string', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'unique:users'],
            'password' => ['nullable', 'string', 'min:6'],
            'is_admin' => 'boolean'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->filled('is_admin');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        } else {
            $randomPassword = Str::random(10);
            $user->password = Hash::make($randomPassword);
            $request->session()->flash('random_password', $randomPassword);
        }

        $user->save();

        return redirect()->route('admin.index')
            ->with('success', 'User ' . $user->name . ' został utworzony.');
    }

    public function edit(User $user)
    {
        return inertia('Admin/User/Edit', [
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete', $user)) {
            return redirect('admin.index')
                ->with('error', 'Brak uprawnień do usunięcia użytkownika');
        }

        $user->delete();

        return redirect()->route('admin.index')
            ->with('success', 'User ' . $user->name . ' został usunięty.');
    }
}
