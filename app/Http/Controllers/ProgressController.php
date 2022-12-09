<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Http\Requests\StoreProgressRequest;
use App\Models\Player;
use App\Models\Slide;
use Carbon\CarbonInterval;


class ProgressController extends Controller
{
    public function store(StoreProgressRequest $request)
    {
        $totalSecons = CarbonInterval::days($request->timeLeft['days'])->hours($request->timeLeft['hours'])->minutes($request->timeLeft['minutes'])->seconds($request->timeLeft['seconds'])->totalSeconds;
        $slide = Slide::find($request->slide);
        $question = $slide->question()->first();
        $player = Player::find(session('player'))->first();
        $score = $question->points * $totalSecons;
        $answer = $question->answers()->where('id', $request->answer)->first();

        if ($answer && !$answer->is_correct) {
            $score = 0;
        }

        if (!$player->progress()->where('slide_id', $slide->id)->first()) {
            Progress::create([
                'points' => $score,
                'player_id' => $player->id,
                'answer_id' => $request->answer,
                'slide_id' => $slide->id,
            ]);

            return redirect()->route('answer.correct', ['answer' => $request->answer]);
        }
    }
}
