<x-flashcards-layout>
    <h2>Mijn sets</h2>

    @foreach($sets as $set)
    <ul class="my-list list-group list-group-horizontal">
        <li class="first-col list-group-item">{{ $set->name }}</li>
        <li class="btn-col list-group-item"><a href="{{ url('/sets' . '/' . $set->id) }}" class="btn btn-light">Details</a></li>
        <li class="btn-col list-group-item"><a href="{{ url('/sets' . '/' . $set->id . '/new_run') }}" class="{{ $set->nr_of_cards == 0 ? 'disabled ' : '' }}btn btn-light">Speel!</a></li>
    </ul>
    @endforeach

    <div class="spacer"></div>

    <p><a href="{{ route('addset') }}" class="btn btn-primary">Voeg een set toe</a></p>
</x-flashcards-layout>
