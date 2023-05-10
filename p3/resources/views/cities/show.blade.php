@extends('layouts/main')

@section('title')
    Cities to visit in {{ $country->country }}
@endsection

@section('head')
@endsection

@section('content')
    <h3 test='city-page'>{{ $city->city }}</h2>
        <p>Explore places to visit in {{ $city->city }}, {{ $country->country }}.</p>

        <a href='/cities' class='btn btn-link' target="_blank">Back to all cities</a>

        @foreach ($places as $place)
            <div class="card-deck">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $place->place }}</h5>
                        <p class="card-text">
                            @include('/layouts/shortdetails')</p>
                        <a class="btn btn-primary stretched-link"
                            href='/{{ $country->code }}/{{ $city->slug }}/{{ $place->slug }}'>
                            Learn more
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
