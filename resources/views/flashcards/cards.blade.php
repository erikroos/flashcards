<x-flashcards-layout>
    <h2>Kaarten van {{ $set->name }}</h2>

    @foreach($cards as $card)
    <ul class="my-list list-group list-group-horizontal">
        <li class="first-col list-group-item">{{ substr($card->front, 0, 20) }} - {{ substr($card->back, 0, 20) }}</li>
        <li class="btn-col list-group-item"><a href="{{ url('/sets' . '/' . $set->id . '/cards/' . $card->id) }}" class="btn btn-light">Pas aan</a></li>
        <li class="btn-col list-group-item"><a href="{{ url('/sets' . '/' . $set->id . '/cards/' . $card->id . '/delete') }}" class="btn btn-light">Verwijder</a></li>
    </ul>
    @endforeach

    <div class="spacer"></div>

    <p>
        <a href="{{ url('/sets' . '/' . $set->id . '/cards/add') }}" class="btn btn-primary">Voeg toe</a>
    </p>

    <p>
        <a href="{{ url('/sets' . '/' . $set->id) }}" class="btn btn-secondary">Terug naar de set</a>
    </p>
</x-flashcards-layout>
