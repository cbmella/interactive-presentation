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
        'active_slide'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
