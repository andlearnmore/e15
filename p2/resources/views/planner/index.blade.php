@extends('layouts/main')

@section('title')
    Itinerary: Select
@endsection

@section('content')
    <div>
        <?php dump($locations); ?>
        <form method='POST' action='/locations'>
            <div></div>
            {{ csrf_field() }}
            @if (count($locations) == 0)
                <p> Check back later for more itinerary options.</p>
            @else
                @foreach ($locations as $slug => $location)
                    <input type='checkbox' name='locations[]' value='{{ $location['slug'] }}'
                        id='{{ $location['slug'] }}'></input>
                    <label for='{{ $location['slug'] }}'> {{ $location['loc_name'] }} <br>
                        {{ $location['description'] }}</label><br>
                @endforeach
            @endif
        </form>

    </div>
    <div>
        {{-- @if (count($locations) == 0)
            <p> Check back later for more itinerary options.</p>
        @else
            <div>
                @foreach ($locations as $slug => $location)
                    <a href='/locations/{{ $slug }}'>
                        <h3>{{ $location['loc_name'] }}</h3>
                    </a>
                @endforeach
            </div>
        @endif --}}
    </div>

    <div class="row" id="form">
        <div class="col-12">
            <div class="text-center">
                <form>
                    <div class="mb-3">
                        <label for="location" class="form-label">Where would you like to go?</label>
                        <input type="text" id="word" name="word" class="form-control" value="Tiergarten">
                        {{-- TODO: update value --}}


                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
