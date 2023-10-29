<x-flashcards-layout>
    <h2>Speelronde {{ $set->name }}</h2>

    <p>Stand: {{ $run->n_correct }} goed van de {{ $run->n_total }}</p>

    <form method="POST" action="{{ url('/runs/' . $run->id . '/play') }}">
        @csrf

        <input type="hidden" name="set_id" value="{{ $set->id }}">
        <input type="hidden" name="run_id" value="{{ $run->id }}">
        <input type="hidden" name="card_id" value="{{ $card->id }}">
        <input type="hidden" name="front2back" value="{{ $front2back }}">

        <div class="mb-3">
            <label for="answer" class="form-label">{{ $question }}</label>
            <input type="text" name="answer" value="" class="form-control">
        </div>

        <input type="submit" name="nextBtn" value="Controleer" class="btn btn-primary">
        <input type="submit" name="stopBtn" value="Stop" class="btn btn-secondary">
    </form>
</x-flashcards-layout>
