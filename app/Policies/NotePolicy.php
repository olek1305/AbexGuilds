<?php

namespace App\Policies;

use App\Models\PlayerSeason;
use App\Models\User;

class NotePolicy
{
    public function update(User $user, PlayerSeason $playerSeason): bool
    {
        return $user->is_admin;
    }
}
