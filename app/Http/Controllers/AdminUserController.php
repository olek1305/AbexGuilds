<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AdminUserController extends Controller
{
    public function index(): Response
    {
        $users = User::select(['id', 'name'])->paginate(60)->withQueryString();
        return Inertia::render('Admin/User/Index',
            [
                'users' => $users
            ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/User/Create');
    }

    public function store(Request $request, User $user): RedirectResponse
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

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if (!auth()->user()->can('update', $user)) {
            return redirect()->route('admin.index')
                ->with('error', 'Brak uprawnień do edycji użytkownika.');
        }

        $request->validate([
            'name' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'email' => ['nullable', 'string', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'is_admin' => 'boolean'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->filled('is_admin');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.index')
            ->with('success', 'Dane użytkownika zaktualizowane.');
    }

    public function destroy(User $user, Request $request): RedirectResponse
    {
        if ($request->get('action') === 'ban') {
            if ($request->has('uuid')) {
                $user->uuid = $request->get('uuid');
                $user->save();
                $user->delete();
            }
        }

        if ($request->get('action') === 'kick') {
            $user->delete();
        }

        return redirect()->route('player.index')
            ->with('success', 'Done');
    }
}
