<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('games.index', [
            'games' => Game::with('user')->latest()->get(),
        ]);
    }

    public function myGames(): View
    {

        return view('games.myGames', [
            'games' => Auth::user()->games,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'plataform' => 'required|array',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Validating the image file
        ]);

        $imageName = time() . '.' . $request->image->extension(); // Generating a unique name for the image
        $request->image->move(public_path('img'), $imageName); // Saving the image to the public/img folder

        $game = new Game();
        $game->title = $request->title;
        $game->gender = $request->gender;
        $game->plataform = $request->plataform;
        $game->price = $request->price;
        $game->image = $imageName;
        $game->user_id = $request->user()->id;
        $game->save();
        session()->flash('success', 'O jogo foi adicionado com sucesso.');

        return redirect(route('games.myGames'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game): View
    {
        $this->authorize('update', $game);

        $game->platform = json_decode($game->platform, true);
        $platformOptions = ['Playstation 5', 'Playstation 4', 'Xbox One', 'Microsoft Windows'];

        return view('games.edit', [
            'game' => $game,
            'platformOptions' => $platformOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game): RedirectResponse
    {
        $this->authorize('update', $game);

        $request->validate([
            'title' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'plataform' => 'required|array',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension(); // Generating a unique name for the image
            $request->image->move(public_path('img'), $imageName); // Saving the image to the public/img folder

            $game->image = $imageName;
        }

        $game->title = $request->title;
        $game->gender = $request->gender;
        $game->plataform = $request->plataform;
        $game->price = $request->price;
        $game->save();
        session()->flash('success', 'O jogo foi editado com sucesso.');

        return redirect(route('games.myGames'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Game $game): RedirectResponse
    {
        $this->authorize('delete', $game);

        $game->delete();
        session()->flash('success', 'O jogo foi excluído com sucesso.');

        return redirect(route('games.myGames'));
    }
}
