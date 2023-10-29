<x-flashcards-layout>
    <h1></h1>

    @if ($card->id > 0)
    <h1>Pas de kaart aan</h1>
    @else
    <h1>Voeg een kaart toe aan de set {{ $set->name }}</h1>
    @endif

    <form method="POST" action="{{ url('/sets') . '/' . $set->id . '/cards/add' }}">
        @csrf

        <input type="hidden" name="id" value="{{ $card->id }}">
        <input type="hidden" name="set_id" value="{{ $set->id }}">

        <div class="mb-3">
            <label for="front" class="form-label">{{ $set->front_descr }}</label>
            <input type="text" name="front" value="{{ $card->front }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="back" class="form-label">{{ $set->back_descr }}</label>
            <input type="text" name="back" value="{{ $card->back }}" class="form-control">
        </div>

        <input type="submit" value="Voeg toe" class="btn btn-primary">
        <a href="{{url()->previous()}}" class="btn btn-secondary">Annuleer</a>
    </form>

</x-flashcards-layout>
