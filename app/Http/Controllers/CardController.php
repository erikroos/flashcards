<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CardController extends Controller
{
    public function show($set_id) : View {
        $set = Set::where('id', $set_id)->first();
        $cards = Card::where('set_id', $set_id)->get();
        return view('flashcards.cards', ['set' => $set, 'cards' => $cards]);
    }

    public function add($set_id) : View {
        $set = Set::where('id', $set_id)->first();

        $card = new Card();
        $card->id = 0;
        $card->set_id = $set_id;
        $card->front = "";
        $card->back = "";

        return view('flashcards.addcard', ['set' => $set, 'card' => $card]);
    }

    public function update($set_id, $card_id) {
        $set = Set::where('id', $set_id)->first();
        $card = Card::where('id', $card_id)->first();
        return view('flashcards.addcard', ['set' => $set, 'card' => $card]);
    }

    /**
     * Handle an incoming new or edit card form.
     *
     * @throws ValidationException
     */
    public function store(Request $request) : RedirectResponse {
        $request->validate([
            'front' => ['required', 'string', 'max:1000'],
            'back' => ['required', 'string', 'max:1000'],
        ]);

        if ($request->id == 0) {
            // New card
            Card::create([
                'set_id' => $request->set_id,
                'front' => $request->front,
                'back' => $request->back,
            ]);
            $message = 'Kaart succesvol aangemaakt';
        } else {
            // Edit card
            $card = Card::find($request->id);
            $card->update([
                'front' => $request->front,
                'back' => $request->back,
            ]);
            $message = 'Kaart succesvol aangepast';
        }

        return redirect('/sets/' . $request->set_id . '/cards')->with('success', $message);
    }

    public function destroy($set_id, $card_id) : RedirectResponse {
        $card = Card::where('id', $card_id)->first();
        $card->delete();

        return redirect('/sets/' . $set_id . '/cards')->with('success', 'Kaart succesvol verwijderd');
    }
}
