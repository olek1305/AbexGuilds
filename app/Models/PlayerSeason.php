<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerSeason extends Model
{
    use HasFactory;

//    protected $table = 'player_seasons';
    protected $fillable = ['player_id', 'season_id', 'damage', 'is_observer', 'is_star', 'guild_id', 'updated_by'];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }
}
