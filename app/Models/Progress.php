<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slide_id',
        'score',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'slide_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
