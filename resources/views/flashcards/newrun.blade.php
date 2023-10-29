<x-flashcards-layout>
    <h1>Nieuwe speelronde {{ $set->name }}</h1>

    <form method="POST" action="{{ route('newrun.post') }}">
        @csrf

        <input type="hidden" name="set_id" value="{{ $set->id }}">

        <div class="mb-3 form-check">
            <label for="front2back" class="form-label">Van {{ $set->front_descr }} naar {{ $set->back_descr }}</label>
            <input type="checkbox" name="front2back" id="front2back" value="1" {{ $run->front2back ? 'checked="checked"' : '' }} class="form-check-input">
        </div>

        <div class="mb-3 form-check">
            <label for="back2front" class="form-label">Van {{ $set->back_descr }} naar {{ $set->front_descr }}</label>
            <input type="checkbox" name="back2front" id="back2front" value="1" {{ $run->back2front ? 'checked="checked"' : '' }} class="form-check-input">
        </div>

        <input type="submit" value="Speel!" class="btn btn-primary">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuleer</a>
    </form>

    <script>
        let checkboxes = document.getElementsByClassName('form-check-input');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('click', function (e) {
                if (document.querySelectorAll('input[type="checkbox"]:checked').length == 0) {
                    e.preventDefault();
                }
            }, false);
        }
    </script>
</x-flashcards-layout>
