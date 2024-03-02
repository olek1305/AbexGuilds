<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Builder;

    class PlayerSeason extends Model
    {
        use HasFactory;

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

        public function scopeLatestGuildId(Builder $query): Builder
        {
            return $query->orderByDesc('guild_id');
        }

        public function scopeFilter(Builder $query, array $filters): Builder
        {
            return $query
                ->when(
                    $filters['guild_id'] ?? false,
                    fn ($query, $value) => $query->where('guild_id', '=', $value)
                )->when(
                    $filters['damageFrom'] ?? false,
                    fn ($query, $value) => $query->where('damage', '>=', $value)
                )->when(
                    $filters['damageTo'] ?? false,
                    fn ($query, $value) => $query->where('damage', '<=', $value)
                )->when(
                    $filters['season_id'] ?? false,
                    fn ($query, $value) => $query->where('season_id', '=', $value)
                );
        }
    }
