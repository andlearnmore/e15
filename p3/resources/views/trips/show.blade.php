@extends('layouts/main')

@section('title')
    My Trip
@endsection

@section('content')
    <h1>My Trip</h1>
    @if ($places->count() == 0)
        <p test='no-places'>You have not added any places to visit.</p>
        <p><a href='/cities'>Explore All Cities to add to your My Trip list.</a></p>
    @else
        @foreach ($cities as $city)
            <h2> {{ $city->city }}</h2>
            <div id='places'>
                @foreach ($places as $place)
                    @if ($place->city_id == $city->id)
                        <div class='location'>
                            <h3>{{ $place->place }} <h3>
                                    <p>
                                        Added {{ $place->pivot->created_at->diffForHumans() }}
                                    </p>
                                    <div>
                                        <a href='/mytrip/{{ $place->slug }}/edit' class='btn btn-primary'>
                                            Edit this place</a>
                                    </div>
                                    <div>
                                        <a href='/mytrip/{{ $place->slug }}/remove' class='btn btn-primary'
                                            test='remove-button'>
                                            Remove from My Trip</a>
                                    </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
@endsection
