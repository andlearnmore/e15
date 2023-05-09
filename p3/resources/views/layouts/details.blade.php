    @if ($place->address)
        <p>{{ $place->address }}</p>
    @endif
    @if ($place->metro)
        <p><b>Metro: </b>{{ $place->metro }}</p>
    @endif
    @if ($place->open)
        <p><b>Hours: </b>{{ $place->open }} - {{ $place->closed }}</p>
    @endif
    @if ($place->visit_length)
        <p>Plan to spend this many hours here: {{ $place->visit_length }}</p>
    @endif
    @if ($place->fee == 1)
        <p>There is a fee to visit {{ $place->place }}.</p>
    @endif
    @if ($place->reservation_reqd == 1)
        <p>A reservation is required.</p>
    @endif
    @if ($place->description)
        <p> {{ $place->description }}
        <p>
    @endif


    <div>
        <a href='{{ $place->url }}' class='btn btn-light' target='_blank'>Learn more</a>
    </div>
