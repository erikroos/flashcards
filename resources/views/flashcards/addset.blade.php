<x-flashcards-layout>
    @if ($set->id > 0)
    <h1>Pas de set {{ $set->name }} aan</h1>
    @else
    <h1>Voeg een set toe</h1>
    @endif

    <form method="POST" action="{{ route('addset.post') }}">
        @csrf

        <input type="hidden" name="id" value="{{ $set->id }}">

        <div class="mb-3">
            <label for="naam" class="form-label">Naam</label>
            <input type="text" name="name" value="{{ $set->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="front_descr" class="form-label">Omschrijving voorkant (bv. Frans of Term)</label>
            <input type="text" name="front_descr" value="{{ $set->front_descr }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="back_descr" class="form-label">Omschrijving achterkant (bv. Nederlands of Definitie)</label>
            <input type="text" name="back_descr" value="{{ $set->back_descr }}" class="form-control">
        </div>

        <input type="submit" value="Sla op" class="btn btn-primary">
        <a href="{{url()->previous()}}" class="btn btn-secondary">Annuleer</a>
    </form>

    </body>
    </html>
</x-flashcards-layout>
