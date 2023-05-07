@extends('layouts/main')

@section('title')
    My Wishlist
@endsection

@section('content')
    @if ($places->count() == 0)
        <p>You have not added any places to visit.</p>
        <p><a href='/cities'>Explore cities and places to add to your wishlist.</a></p>
    @else
        @foreach ($cities as $city)
            <h2> {{ $city->city }}</h2>
            <div id="places">
                @foreach ($places as $place)
                    @if ($place->city_id == $city->id)
                        <div class='location'>
                            <h3>{{ $place->place }} <h3>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
@endsection
