<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

    public function firstSlide()
    {
        return $this->slides()->first();
    }
}
