<?php

namespace App\Http\Controllers;

use App\Models\Run;
use App\Models\Set;
use App\Models\Card;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SetController extends Controller
{
    public static function getAllSetsForCurrentUser() : Collection {
        $sets = Set::where('user_id', Auth::id())->get();
        foreach ($sets as $set) {
            $cards = Card::where('set_id', $set->id)->get();
            $set->nr_of_cards = sizeof($cards);
        }
        return $sets;
    }

    /**
     * Handle an incoming new or edit set form.
     *
     * @throws ValidationException
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'front_descr' => ['required', 'string', 'max:1000'],
            'back_descr' => ['required', 'string', 'max:1000'],
        ]);

        if ($request->id == 0) {
            // New set
            Set::create([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'front_descr' => $request->front_descr,
                'back_descr' => $request->back_descr,
            ]);
            $message = 'Set succesvol aangemaakt';
        } else {
            // Edit set
            $set = Set::find($request->id);
            $set->update([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'front_descr' => $request->front_descr,
                'back_descr' => $request->back_descr,
            ]);
            $message = 'Set succesvol aangepast';
        }

        return redirect(RouteServiceProvider::HOME)->with('success', $message);
    }

    public function show($set_id) : View {
        $set = Set::where('id', $set_id)->first();
        $number_of_cards = Card::where('set_id', $set_id)->count();
        return view('flashcards.set', ['set' => $set, 'number_of_cards' => $number_of_cards]);
    }

    public function add() : View {
        $set = new Set();
        $set->id = 0;
        $set->front_descr = "";
        $set->back_descr = "";
        return view('flashcards.addset', ['set' => $set]);
    }

    public function update($set_id) : View {
        $set = Set::where('id', $set_id)->first();
        return view('flashcards.addset', ['set' => $set]);
    }

    public function destroy($set_id) : RedirectResponse {
        $set = Set::where('id', $set_id)->first();
        $set->delete();

        return redirect(RouteServiceProvider::HOME)->with('success', 'Set succesvol verwijderd');
    }

    public function add_run($set_id) : View {
        $set = Set::where('id', $set_id)->first();

        $run = new Run();
        $run->id = 0;
        $run->front2back = 1;
        $run->back2front = 1;
        $run->n_total = 0;
        $run->n_correct = 0;
        return view('flashcards.newrun', ['run' => $run, 'set' => $set]);
    }
}
