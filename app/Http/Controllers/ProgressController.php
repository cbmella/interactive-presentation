<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgressRequest;
use App\Models\Player;
use App\Models\Slide;
use Carbon\CarbonInterval;


class ProgressController extends Controller
{
    /**
     * Guarda el progreso del jugador en una diapositiva en particular.
     *
     * @param StoreProgressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProgressRequest $request)
    {
        // Obtiene el modelo Player, Slide y Answer relevantes
        $slide = Slide::find($request->slide);
        $question = $slide->question()->first();
        $player = session('player');
        // Calcula la puntuación del jugador
        $score = $question->points * CarbonInterval::days($request->timeLeft['days'])
            ->hours($request->timeLeft['hours'])
            ->minutes($request->timeLeft['minutes'])
            ->seconds($request->timeLeft['seconds'])
            ->totalSeconds;


        $answer = $question->answers()->where('id', $request->answer)->first();
        // Si la respuesta es incorrecta o no existe alguna respuesta, la puntuación se establece en cero
        $score = ($answer && !$answer->is_correct) ? 0 : $score;
        // Si no se ha registrado el progreso del jugador en esta diapositiva, se crea un nuevo registro Progress en la base de datos
        if (!$player->progress()->where('slide_id', $slide->id)->first()) {

            $player->progress()->create([
                'points' => $score,
                'player_id' => $player->id,
                'answer_id' => $request->answer,
                'slide_id' => $slide->id,
            ]);

            // Redirige al usuario a la ruta answer.correct
            return redirect()->route('answer.correct', ['answer' => $request->answer]);
        }
    }
}
