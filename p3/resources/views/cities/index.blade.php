@extends('layouts/main')

@section('title')
    Cities to visit
@endsection

@section('head')
@endsection

@section('content')
    <p>All of the cities and countries.</p>
    @foreach ($countries as $country)
        <h2>{{ $country->country }}</h2>
        <div id="cities">
            @foreach ($cities as $city)
                @if ($city->country_id == $country->id)
                    @if (Auth::user())
                        <div class="location">
                            <a href='/{{ $country->code }}/{{ $city->slug }}'>
                                <h4> {{ $city->city }}</h4>
                            </a>
                        </div>
                    @else
                        <div class="location">
                            <h4> {{ $city->city }}</h4>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    @endforeach
@endsection
