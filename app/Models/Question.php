<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'time',
        'points',
        'slide_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'slide_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
