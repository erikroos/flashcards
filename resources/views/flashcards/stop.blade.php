<x-flashcards-layout>
    <h1>Einde van speelronde met {{ $set->name }}</h1>
    <p>Eindstand: {{ $run->n_correct }} goed van de {{ $run->n_total }} ({{ $run->perc_correct }}%)</p>
    <p>Duur: {{ $run->duration }} sec.</p>

    <a href="{{ url('/sets/' . $set->id) }}" class="btn btn-primary">Terug naar de set</a>
</x-flashcards-layout>
