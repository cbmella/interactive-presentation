<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'answer_id',
        'slide_id',
        'score',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'player_id',
        'answer_id',
        'slide_id',
    ];

    public function scopeSumScorePerPlayer($query, $presentation)
    {
        return $query->select('players.name', \DB::raw('SUM(score) as score'))
            ->join('players', 'players.id', '=', 'progress.player_id')
            ->join('presentation', 'presentation.id', '=', 'players.presentation_id')
            ->where('presentation.id', '=', $presentation)
            ->groupBy('player_id')
            ->orderBy('score', 'desc')
            ->get();
    } 
}
