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

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function question()
    {
        return $this->hasOne(Question::class);
    }


    public function nextSlide()
    {
        return $this->presentation->slides()->where('id', '>', $this->id)->first();
    }

    public function lastSlide()
    {
        return $this->presentation->slides()->orderBy('id', 'desc')->first();
    }
}
