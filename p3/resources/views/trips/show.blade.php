@extends('layouts/main')

@section('title')
    My Trip
@endsection

@section('content')
    <div class="col">

        <h1>My Trip</h1>
        <p>My Trip is a list of all of the places you'd like to see, organized by city; a travel wishlist of sorts.</p>
        @if ($places->count() == 0)
            <p test='no-places'>You have not added any places to visit.</p>
            <p><a href='/cities'>Explore All Cities to add to your My Trip list.</a></p>
        @else
            @foreach ($cities as $city)
                <div class="col">
                    <h2> {{ $city->city }}</h2>
                    <div class="card-deck">

                        @foreach ($places as $place)
                            @if ($place->city_id == $city->id)
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title" test='mytrip-place-link'>{{ $place->place }} </h3>
                                        <p class="card-text">
                                            Added {{ $place->pivot->created_at->diffForHumans() }}
                                        </p>
                                        <div>
                                            <a class='btn btn-light' href='/mytrip/{{ $place->slug }}/edit'>
                                                Edit</a>
                                        </div>
                                        <br>
                                        <div>
                                            <a class='btn btn-light' href='/mytrip/{{ $place->slug }}/remove'
                                                test='remove-button'>
                                                Remove from My Trip</a>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
