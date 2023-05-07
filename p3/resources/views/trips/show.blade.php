@extends('layouts/main')

@section('title')
    My Trip
@endsection

@section('content')
    @if ($places->count() == 0)
        <p>You have not added any places to visit.</p>
        <p><a href='/cities'>Explore All Cities to add to your My Trip list.</a></p>
    @else
        @foreach ($cities as $city)
            <h2> {{ $city->city }}</h2>
            <div id="places">
                @foreach ($places as $place)
                    @if ($place->city_id == $city->id)
                        <div class='location'>
                            <h3>{{ $place->place }} <h3>
                                    <p class='added'>
                                        Added {{ $place->pivot->created_at->diffForHumans() }}
                                    </p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
@endsection
