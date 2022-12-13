<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Player;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
use App\Services\SlideService;
use Inertia\Inertia;


class PresentationController extends Controller
{
    public function index()
    {
        $presentations = Presentation::all();

        return Inertia::render('Presentations/Index', [
            'presentations' => $presentations,
        ]);
    }

    public function create()
    {
        return Inertia::render('Presentations/Create');
    }

    public function store(StorePresentationRequest $request)
    {
        $presentation = Presentation::create($request->validated());

        return redirect()->route('presentations.index');
    }

    public function show(Presentation $presentation)
    {
        return Inertia::render('Presentations/Show', [
            'presentation' => $presentation,
        ]);
    }

    public function edit(Presentation $presentation)
    {
        return Inertia::render('Presentations/Edit', [
            'presentation' => $presentation,
        ]);
    }

    public function update(UpdatePresentationRequest $request, Presentation $presentation)
    {
        $presentation->update($request->validated());

        return redirect()->route('presentations.index');
    }

    public function destroy(Presentation $presentation)
    {
        $presentation->delete();

        return redirect()->route('presentations.index');
    }

    public function video(Presentation $presentation, $player)
    {
        $player = Player::firstOrCreate(
            ['presentation_id' => $presentation->id, 'key' => $player],
            ['key' => $player]
        );

        $player->tokens()->delete();
        $token = $player->createToken('player-token')->plainTextToken;
        session([
            'player' => $player,
            'token' => $token,
            'presentation' => $presentation,
        ]);
        return Inertia::render('Video', [
            'presentation' => $presentation,
        ]);
    }

    public function qr()
    {
        $url = route('players.generate', ['token' => session('token')]);
        $qr = 'data:image/svg+xml;base64,' . base64_encode(QrCode::format('svg')->size(100)->generate($url));

        return Inertia::render('QR', [
            'qr' => $qr,
        ]);
    }

    public function fistSlide(SlideService $slideService)
    {
        $slide = $slideService->getSlide(session('presentation')->firstSlide());

        return redirect()->route('slides.render', $slide);
    }

    public function top()
    {
        $presentation = session('presentation');

        $topPlayers = $presentation->players()->topPlayers()->get();

        return Inertia::render('Top', [
            'topPlayers' => $topPlayers,
        ]);
    }
}
