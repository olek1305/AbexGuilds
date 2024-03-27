<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AdminUserRestoreController extends Controller
{
    public function index(): Response
    {
        $users = User::withTrashed()
            ->select(['id', 'name', 'deleted_at'])
            ->get()
            ->toArray();

        return Inertia::render('Admin/User/Restore/Index',
            [
                'users' => $users
            ]);
    }

    public function restore(User $user): RedirectResponse
    {
        if (! $user->trashed()) {
            return back()->with('error', 'Użytkownik nie jest usunięty');
        }

        $user->restore();
        return  redirect()->route('admin.index')
            ->with('success', 'Użytkownika przywrócono');
    }
}
