<?php

namespace App\Policies;

use App\Models\PlayerSeason;
use App\Models\User;

class PlayerSeasonPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function update(User $user, PlayerSeason $playerSeason): bool
    {
        return $user->is_admin;
    }
}
