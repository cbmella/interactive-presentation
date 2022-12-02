<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'presentation_id'
    ];
}
