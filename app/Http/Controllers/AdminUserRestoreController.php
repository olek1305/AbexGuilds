<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserRestoreController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()
            ->select(['id', 'name', 'deleted_at'])
            ->get()
            ->toArray();

        return inertia('Admin/User/Restore/Index',
            [
                'users' => $users
            ]);
    }

    public function restore(User $user)
    {
        if (! $user->trashed()) {
            return back()->with('error', 'Użytkownik nie jest usunięty');
        }

        $user->restore();
        return  redirect()->route('admin.index')
            ->with('success', 'Użytkownika przywrócono');
    }
}
