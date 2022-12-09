<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Services\SlideService;
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

    public function next(Slide $slide, SlideService $slideService)
    {
        if ($slide->nextSlide()) {
            $slide = $slideService->getSlide($slide->nextSlide());
            return redirect()->route('slides.show', $slide);
        }
        //aca mandar a la vista de score
        return redirect()->route('slides.show',  $slide->lastSlide());
    }

    public function active(Slide $slide)
    {
        $question = $slide->question()->first();

        $data = [
            'slide' => $slide,
        ];

        if ($question) {
            $data['question'] = $question;
            $data['answers'] = $question->answers()->get();
        }

        return Inertia::render('Active', $data);
    }
}
