<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public function updateIsAdmin(User $currentUser, User $user): bool
    {
        return $currentUser->is_admin;
    }

    public function delete(User $user)
    {
        return $user->id === auth()->id() || auth()->user()->can('admin');
    }
}
