<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Run;
use App\Models\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RunController extends Controller
{
    /**
     * Handle an incoming new run form.
     *
     * @throws ValidationException
     */
    public function store(Request $request) : RedirectResponse
    {
        $run = Run::create([
            'user_id' => Auth::id(),
            'set_id' => $request->set_id,
            'front2back' => $request->has('front2back'),
            'back2front' => $request->has('back2front'),
            'started_at' => date('Y-m-d H:i:s'),
            'n_total' => 0,
            'n_correct' => 0,
        ]);

        return redirect('/runs/' . $run->id . '/play');
    }

    public function play($run_id) : View {
        $run = Run::where('id', $run_id)->first();
        $set = Set::where('id', $run->set_id)->first();

        $card = Card::where('set_id', $run->set_id)->get()->random();

        $front2back = true;
        if ($run->front2back == 1 && $run->back2front == 1) {
            if (rand(0, 1) == 0) {
                $question = $card->front;
            } else {
                $front2back = false;
                $question = $card->back;
            }
        } else if ($run->front2back == 1) {
            $question = $card->front;
        } else {
            $front2back = false;
            $question = $card->back;
        }

        return view('flashcards.play', ['run' => $run, 'set' => $set, 'card' => $card, 'question' => $question, 'front2back' => $front2back]);
    }

    public function check(Request $request) : RedirectResponse {
        if ($request->has('stopBtn')) {
            return redirect('/runs/' . $request->run_id . '/stop');
        }

        $run = Run::where('id', $request->run_id)->first();
        $card = Card::where('id', $request->card_id)->first();

        if ($request->front2back == 1) {
            $distance = levenshtein($request->answer, $card->back);
            if ($distance == 0) {
                $run->n_correct += 1;
                $message_kind = 'success';
                $message = 'Goed gedaan!';
            } else if ($distance < 3) {
                $run->n_correct += 1;
                $message_kind = 'info';
                $message = 'Goed gedaan, maar let op de spelling: ' . $card->back;
            } else {
                $message_kind = 'error';
                $message = 'Helaas... het moest zijn: ' . $card->back;
            }
        } else {
            $distance = levenshtein($request->answer, $card->front);
            if ($distance == 0) {
                $run->n_correct += 1;
                $message_kind = 'success';
                $message = 'Goed gedaan!';
            } else if ($distance < 3) {
                $run->n_correct += 1;
                $message_kind = 'info';
                $message = 'Goed gedaan, maar let op de spelling: ' . $card->front;
            } else {
                $message_kind = 'error';
                $message = 'Helaas... het moest zijn: ' . $card->front;
            }
        }

        $run->n_total += 1;

        $run->update([
            'n_total' => $run->n_total,
            'n_correct' => $run->n_correct,
        ]);

        return redirect('/runs/' . $request->run_id . '/play')->with($message_kind, $message);
    }

    public function stop($run_id) : View {
        $run = Run::where('id', $run_id)->first();
        $set = Set::where('id', $run->set_id)->first();

        $now = date('Y-m-d H:i:s');

        $run->update([
            'ended_at' => $now,
        ]);

        $run->duration = strtotime($now) - strtotime($run->started_at);
        $run->perc_correct = round(($run->n_correct / $run->n_total) * 100, 2);

        return view('flashcards.stop', ['run' => $run, 'set' => $set]);
    }
}
