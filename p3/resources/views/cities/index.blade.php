@extends('layouts/main')

@section('title')
    Cities to visit
@endsection

@section('head')
@endsection

@section('content')
    <div class="col">
        @if (!Auth::user())
            <p test='login-encourage'>Log in to see places to visit in each city.</p>
        @endif
        @foreach ($countries as $country)
            <h2>{{ $country->country }}</h2>
            @foreach ($cities as $city)
                @if ($city->country_id == $country->id)
                    @if (Auth::user())
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" test='card-title'> {{ $city->city }}</h4>
                                    <a class="btn btn-sm stretched-link" test='city-link'
                                        href='/{{ $country->code }}/{{ $city->slug }}'>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> {{ $city->city }}</h4>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
    </div>
    @endforeach
    </div>
@endsection
