<x-flashcards-layout>
    <h2>Set {{ $set->name }}</h2>
    <p>
        Omschrijving voorkant: {{ $set->front_descr }}<br>
        Omschrijving achterkant: {{ $set->back_descr }}
    </p>
    <p>
        <a href="{{ url('/sets' . '/' . $set->id . '/edit') }}" class="btn btn-primary">Pas aan</a>
    </p>

    <h3>Kaarten</h3>
    <p>
        Huidig aantal kaarten: {{ $number_of_cards }}
    </p>
    <p>
        <a href="{{ url('/sets' . '/' . $set->id . '/cards') }}" class="btn btn-primary">Bekijk / pas aan</a>
    </p>

    <h3>Verwijderen</h3>
    <p>
        <a href="{{ url('/sets' . '/' . $set->id . '/delete') }}" class="btn btn-danger">Verwijder</a>
    </p>
</x-flashcards-layout>
