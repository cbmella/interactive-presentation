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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresentationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        /*         return Inertia::render('Presentation', [
            'presentation' => $presentation,
        ]); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresentationRequest  $request
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresentationRequest $request, Presentation $presentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
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
