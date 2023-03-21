@extends('layouts/main')

@section('title')
    Itinerary Planner
@endsection

@section('content')
    <div>
        {{-- <?php dump($locations); ?> --}}
        <div>
            <h1>Welcome to the Berlin Trip Planner.</h1>
            <p>You're going to Berlin&mdash;how exciting! Let us help you plan your trip.</p>
            <p>Tell us a bit about your trip, then select the places you'd like to visit below and we'll plan an itinerary
                for you.</p>
        </div>

        <form method='GET' action='/create'>
            <div id="form">
                {{-- Trip Length --}}
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mb-3">
                                <h5>How many days will you be in Berlin?</h5>
                                @if ($errors->get('tripLength'))
                                    <div class='alert alert-danger'>{{ $errors->first('tripLength') }}</div>
                                @endif
                                <select id='tripLength' name='tripLength'>
                                    <option value=1>1 day</option>
                                    <option value=2>2 days</option>
                                    <option value=3>3 days</option>
                                    <option value=4>4 days</option>
                                    <option value=5>5 days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Time Selection --}}
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mb-3">
                                <h5>Do you prefer to get an early start on the day or close the place down?</h5>
                                @if ($errors->get('timeSelection'))
                                    <div class='alert alert-danger'>{{ $errors->first('timeSelection') }}</div>
                                @endif

                                <input type='radio' id='early' name='timeSelection' value='early'
                                    {{ old('timeSelection') == 'early' ? 'checked' : '' }}>
                                <label for='early'>Early Bird</label>
                                <input type='radio' id='late' name='timeSelection' value='late'
                                    {{ old('timeSelection') == 'late' ? 'checked' : '' }}>
                                <label for='late'>Night Owl</label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Itinerary Name --}}
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mb-3">
                                <label for="itineraryName" class="form-label">
                                    <h5>What would you like to call this itinerary?</h5>
                                </label>
                                @if ($errors->get('itineraryName'))
                                    <div class='alert alert-danger'>{{ $errors->first('itineraryName') }}</div>
                                @endif
                                <input type="text" id="itineraryName" name="itineraryName" class="form-control"
                                    value='{{ old('itineraryName', 'My Berlin Itinerary') }}'>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Location Selector --}}
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mb-3">
                                <h5>Where would you like to visit?</h5>
                                <p>Click on the locations you'd like to see while you're in Berlin.</p>
                                @if ($errors->get('formPlaces'))
                                    <div class='alert alert-danger'>{{ $errors->first('formPlaces') }}</div>
                                @endif

                                @if (count($locations) == 0)
                                    <p> Check back later for more itinerary options.</p>
                                @else
                                    @foreach ($locations as $slug => $location)
                                        <input type='checkbox' id='{{ $location['slug'] }}' name='formPlaces[]'
                                            value='{{ $location['slug'] }}'></input>
                                        <label for='{{ $location['slug'] }}'> <b>{{ $location['loc_name'] }}</b>
                                            <br>
                                            {{-- TODO: Insert span instead of using <b></b> --}}
                                            {{ $location['description'] }} <br>
                                            {{ $location['loc_open'] }} - {{ $location['loc_closed'] }}<br>
                                            Average visit length: {{ $location['loc_visit_length'] }} hours </label> <br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Submit --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </div>
    </div>
    </div>
    </div>
    </form>

    </div>
@endsection
