<?php

namespace App\Services;

use App\Models\Slide;
use App\Events\activeSlide;

class SlideService
{
    public function getSlide($slide): Slide
    {
        $player = session('player');
        $player->active_slide = $slide->id;
        $player->save();
        event(new activeSlide($player->active_slide, $player->id));
        return Slide::find($slide->id);
    }
}
