<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PlayerController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(StorePlayerRequest $request)
    {
        /*       $player = Player::create($request->all());
        dd($player);
        return redirect()->route('slides.show', $slide); */
    }


    public function show(Player $player)
    {
        //
    }


    public function edit(Player $player)
    {
        //
    }


    public function update(UpdatePlayerRequest $request, Player $player)
    {
    }


    public function destroy(Player $player)
    {
        //
    }


    public function generate(Player $player, $token)
    {
        session([
            'player' => $player,
            'token' => $token,
        ]);

        $avatar = Str::random(10);

        $data = [
            'name' => Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['title'] . ' ' .  Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['first'] . ' ' . Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['last'],
            'avatar' => Http::get('https://api.multiavatar.com/' . $avatar . '.svg')->body(),
            'url' => 'https://api.multiavatar.com/' . $avatar . '.svg',
            'player' => session('player'),
            'token' => session('token')
        ];

        return Inertia::render('Player', $data);
    }

    public function next(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->all());
        return redirect()->route('players.wait');
    }

    public function wait()
    {
        return Inertia::render('Wait', [
            'player' => session('player'),
            'token' => session('token')
        ]);
    }
}
