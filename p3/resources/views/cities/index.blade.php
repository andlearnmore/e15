@extends('layouts/main')

@section('title')
    Cities to visit
@endsection

@section('head')
@endsection

@section('content')
    @if (!Auth::user())
        <p test='login-encourage'>Log in to see places to visit in each city.</p>
    @endif
    @foreach ($countries as $country)
        <div class='location'>
            <h2>{{ $country->country }}</h2>
            <div class="cities">
                @foreach ($cities as $city)
                    @if ($city->country_id == $country->id)
                        @if (Auth::user())
                            <div class="location">
                                <a test='city-link' href='/{{ $country->code }}/{{ $city->slug }}'>
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
        </div>
    @endforeach
@endsection
