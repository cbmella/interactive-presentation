<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;

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


    public function generate($token)
    {
        $personal_access_token = PersonalAccessToken::findToken($token);
        $player = $personal_access_token->tokenable;

        session([
            'token' => $token,
            'player' => $player
        ]);

        $avatar = Str::random(10);

        return Inertia::render('Player', [
            'name' => Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['title'] . ' ' .  Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['first'] . ' ' . Http::get('https://randomuser.me/api/')->json()['results'][0]['name']['last'],
            'avatar' => Http::get('https://api.multiavatar.com/' . $avatar . '.svg')->body(),
            'url' => 'https://api.multiavatar.com/' . $avatar . '.svg',
            'player' => session('player'),
            'token' => session('token')
        ]);
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
