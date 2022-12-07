<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Player;
use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
use App\Services\SlideService;
use Inertia\Inertia;

class PresentationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StorePresentationRequest $request)
    {
        //
    }

    public function show(Presentation $presentation)
    {
        /*         return Inertia::render('Presentation', [
            'presentation' => $presentation,
        ]); */
    }

    public function edit(Presentation $presentation)
    {
        //
    }

    public function update(UpdatePresentationRequest $request, Presentation $presentation)
    {
        //
    }

    public function destroy(Presentation $presentation)
    {
        //
    }

    public function player(Presentation $presentation, $player)
    {
        $player = Player::firstOrCreate(
            ['key' => $player],
            ['key' => $player]
        );

        $player->tokens()->delete();
        $token = $player->createToken('player-token')->plainTextToken;
        session([
            'player' => $player,
            'token' => $token,
        ]);
        return Inertia::render('Presentation', [
            'presentation' => $presentation,
        ]);
    }

    public function ready(Presentation $presentation, SlideService $slideService)
    {
        $slide = $slideService->getSlide($presentation->firstSlide());
        return redirect()->route('slides.show', $slide);
    }
}
