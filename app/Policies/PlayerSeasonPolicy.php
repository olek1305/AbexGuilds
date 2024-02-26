<?php

namespace App\Policies;

use App\Models\PlayerSeason;
use App\Models\User;

class PlayerSeasonPolicy
{
    public function before(?User $user, $ability)
    {
        if ($user?->is_admin){
            echo "is work?";
            return true;
        }
    }

    public function viewAny(?User $user)
    {
        return true;
    }

    public function update(User $user, PlayerSeason $playerSeason)
    {
        return $user->id === $playerSeason->player_id;
    }
}
