<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Builder;

    class PlayerSeason extends Model
    {
        use HasFactory;

        public mixed $user;
        protected $fillable = ['player_id', 'season', 'damage', 'is_observer', 'is_star', 'guild_id', 'updated_by'];

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

        public function scopeLatestIsStar(Builder $query): Builder
        {
            return $query->orderByDesc('is_star');
        }

        public function scopeLatestDamage(Builder $query): Builder
        {
            return $query->orderByDesc('damage');
        }

        public function scopeFirstIsObserver(Builder $query): Builder
        {
            return $query->orderBy('is_observer');
        }

        public function isAdmin(): bool
        {
            return $this->user->is_admin;
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
                    $filters['season'] ?? false,
                    fn ($query, $value) => $query->where('season', '=', $value)
                )->when(
                    $filters['player_name'] ?? false,
                    fn ($query, $value) => $query->whereHas('user',fn ($query) => $query->where('name', 'LIKE', "%$value%"))
                );
        }
    }
