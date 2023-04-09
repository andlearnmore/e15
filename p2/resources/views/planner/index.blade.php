@extends('layouts/main')

@section('title')
    Berlin Trip Planner
@endsection

@section('head')
    <link href='/css/planner/index.css' rel='stylesheet'>
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
            <div id="form" class='form'>
                {{-- @if (isset($tooMuch))
                    @if ($tooMuch == true)
                        <div class='alert alert-danger' role='alert'>You're trying to squeeze a lot in! Please select a
                            longer trip or fewer locations to visit.</div>
                    @endif
                @endif --}}
                {{-- Trip Length --}}
                <div class="row">
                    <div class='col-3'></div>
                    <div class="col-6">
                        <div class="mb-3">
                            <h5>How many days will you be in Berlin?</h5>
                            @if ($errors->get('tripLength'))
                                <div class='alert alert-danger'>{{ $errors->first('tripLength') }}</div>
                            @endif
                            <select class='form-select' id='tripLength' name='tripLength'>
                                <option value=1>1 day</option>
                                <option value=2>2 days</option>
                                <option value=3>3 days</option>
                                <option value=4>4 days</option>
                                <option value=5>5 days</option>
                            </select>
                        </div>
                    </div>
                    <div class='col-3'></div>
                </div>
                {{-- Time Selection --}}
                <div class="row">
                    <div class='col-3'></div>
                    <div class="col-6">
                        <div class="mb-3">
                            <h5>Do you prefer to get an early start on the day or close the place down?</h5>
                            @if ($errors->get('timeSelection'))
                                <div class='alert alert-danger'>{{ $errors->first('timeSelection') }}</div>
                            @endif
                            <div class='form-check'>
                                <div class='col'>
                                    <input class='form-check-input' type='radio' id='early' name='timeSelection'
                                        value='early' {{ old('timeSelection') == 'early' ? 'checked' : '' }}>
                                    <label class='form-check-label' for='early'>Early Bird</label>
                                    <input class='form-check-input' type='radio' id='late' name='timeSelection'
                                        value='late' {{ old('timeSelection') == 'late' ? 'checked' : '' }}>
                                    <label class='form-check-label' for='late'>Night Owl</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'></div>

                </div>
                {{-- Itinerary Name --}}
                <div class="row">
                    <div class='col-3'></div>
                    <div class="col-6">
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
                    <div class='col-3'></div>

                </div>
                {{-- Location Selector Label --}}
                <div class='row'>
                    <div class='col-3'></div>
                    <div class="col-6">
                        <div class="mb-3">
                            <h5>Where would you like to visit?</h5>
                            <p>Click on the locations you'd like to see while you're in Berlin.</p>

                            {{-- Display errors, if any --}}
                            @if ($errors->get('formPlaces'))
                                <div class='alert alert-danger'>{{ $errors->first('formPlaces') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class='col-3'></div>
                </div>
                {{-- Display Locations --}}
                <div class='row'>
                    @if (count($locations) == 0)
                        <p> Check back later for more itinerary options.</p>
                    @else
                        <div class='form-check' id='locations'>
                            @foreach ($locations as $slug => $location)
                                <label class='form-check-label' for='{{ $location['slug'] }}'>
                                    <div class='card' style='width: 18rem;'>
                                        <div class='card-body'>

                                            <h5 class='card-title'>{{ $location['loc_name'] }}</h5>
                                            <p class='card-text'>{{ $location['description'] }}</p>
                                            <p class='card-text'> Hours: {{ $location['loc_open'] }} -
                                                {{ $location['loc_closed'] }}</p>
                                            <p class='card-text'>Average visit length:
                                                {{ $location['loc_visit_length'] }} hours</p>
                                            <p class='card-text text-center'>
                                                <input class='form-check-input' type='checkbox'
                                                    id='{{ $location['slug'] }}' name='formPlaces[]'
                                                    value='{{ $location['slug'] }}'>
                                                </input>
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                {{-- Submit --}}
                <div class='row'>
                    <div class='col-12'>
                        <div class='text-center'>
                            <button type="submit" class="btn btn-secondary" id='locSubmit'>Submit</button>
                        </div>
                    </div>


                </div>
        </form>
    </div>
@endsection
