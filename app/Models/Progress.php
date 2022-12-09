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
}
