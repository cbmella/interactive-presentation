<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Player extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'key',
        'avatar',
        'active_slide',
        'presentation_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }



    public function scopeTopPlayers($query, $limit = 10)
    {
        return $query
            ->select('name')
            ->selectRaw('SUM(points) as points')
            ->join('progress', 'players.id', '=', 'progress.player_id')
            ->groupBy('players.id', 'players.name')
            ->orderByDesc('points')
            ->limit($limit);
    }
}
