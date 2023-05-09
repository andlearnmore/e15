    @if ($place->address)
        <p>{{ $place->address }}</p>
    @endif
    @if ($place->open)
        <p><b>Hours: </b>{{ $place->open }} - {{ $place->closed }}</p>
    @endif
    @if ($place->description)
        <p> {{ $place->description }}</p>
    @endif
