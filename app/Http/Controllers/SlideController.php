<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Services\SlideService;
use App\Services\ChartService;
use Inertia\Inertia;

class SlideController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreSlideRequest $request)
    {
        //
    }

    public function show(Slide $slide)
    {
        return Inertia::render('Slide', [
            'slide' => $slide,
        ]);
    }

    public function edit(Slide $slide)
    {
        //
    }

    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        //
    }

    public function destroy(Slide $slide)
    {
        //
    }

    public function render(Slide $slide, ChartService $chartService)
    {
        $data = [
            'slide' => $slide,
        ];

        $question = $slide->question()->first();

        if ($question) {
            $chartdata = $chartService->getChartdata($question->answers()->get());
            $data = array_merge($data, [
                'question' => $question,
            ]);
            $data = array_merge($data, $chartdata);
        }

        return Inertia::render('Slide', $data);
    }

    public function next(Slide $slide, SlideService $slideService)
    {
        if ($slide->nextSlide()) {
            $slide = $slideService->getSlide($slide->nextSlide());
            return redirect()->route('slides.render', $slide);
        }
        //aca mandar a la vista de score
        return redirect()->route('slides.render',  $slide->lastSlide());
    }

    public function active(Slide $slide)
    {
        $question = $slide->question()->first();

        if (!session('player')->progress()->where('slide_id', $slide->id)->first()) {
            if (!$question) {
                return Inertia::render('Active', [
                    'slide' => $slide,
                ]);
            }
            return Inertia::render('Active', [
                'slide' => $slide,
                'question' => $question,
                'answers' => $question->answers()->get(),
            ]);
        }

        session()->forget('_previous', url()->previous());
        return redirect()->route('players.wait');
    }
}
