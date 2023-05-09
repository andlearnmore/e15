@extends('layouts/main')

@section('title')
@endsection

@section('head')
@endsection

@section('content')
    <div>
        <h1>Edit {{ $place->place }} </h1>
    </div>
    <form method='POST' action='/mytrip/{{ $place->slug }}' class='form'>
        <div class='details'>* required fields</div>
        {{ method_field('put') }}

        {{ csrf_field() }}

        <div>
            <label for='place'>* Place Name</label>
            <input type='text' name='place' id='place' value='{{ old('place', $place->place) }}'>
            @include('includes.error-field', ['fieldName' => 'place'])
        </div>

        <div>
            <label for='city_id'> * City</label>
            <select name='city_id' id='city_id'>
                <option value=''>Choose one...</option>
                @foreach ($cities as $city)
                    <option value='{{ $city->id }}'
                        {{ (old('city') == $city->id or isset($place->city_id) and $place->city_id == $city->id) ? 'selected' : '' }}>
                        {{ $city->city }} </option>
                @endforeach
            </select>
            @include('includes.error-field', ['fieldName' => 'city_id'])
        </div>

        <div>
            <label for='url'>* Website</label>
            <input type='text' name='url' id='url' value='{{ old('url)', $place->url) }}'>
            @include('includes.error-field', ['fieldName' => 'url'])
        </div>

        <div>
            <fieldset>
                <label for='open_hour'>Opens</label>
                <select name='open_hour' id='open_hour'>
                    @foreach ($hours as $hour)
                        <option value='{{ $hour }}'
                            {{ (old('hour') == $hour or isset($place->open_hour) and $place->open_hour == $hour) ? 'selected' : '' }}>
                            {{ $hour }}
                        </option>
                    @endforeach
                </select>
                <select name='open_minute' id='open_minute'>
                    @foreach ($minutes as $minute)
                        <option value='{{ $minute }}'
                            {{ (old('open_minute') == $minute or isset($place->open_minute) and $place->open_minute == $minute) ? 'selected' : '' }}>
                            {{ $minute }}
                        </option>
                    @endforeach
                </select>
                @include('includes.error-field', ['fieldName' => 'open_hour'])
                @include('includes.error-field', ['fieldName' => 'open_minute'])
            </fieldset>
        </div>

        <div>
            <fieldset>
                <label for='closed'>Closes</label>
                <select name='closed_hour' id='closed_hour'>
                    @foreach ($hours as $hour)
                        <option value='{{ $hour }}'
                            {{ (old('closed_hour') == $hour or isset($place->closed_hour) and $place->closed_hour == $hour) ? 'selected' : '' }}>
                            {{ $hour }}
                        </option>
                    @endforeach
                </select>
                <select name='closed_minute' id='closed_minute'>
                    @foreach ($minutes as $minute)
                        <option value=' {{ $minute }}'
                            {{ (old('closed_minute') == $minute or isset($place->closed_minute) and $place->closed_minute == $minute) ? 'selected' : '' }}>
                            {{ $minute }}
                        </option>
                    @endforeach
                </select>
                @include('includes.error-field', ['fieldName' => 'open'])
            </fieldset>
        </div>

        <div>
            <label for='metro'>Metro</label>
            <input type='text' name='metro' id='metro' value='{{ old('metro', $place->metro) }}'>
            @include('includes.error-field', ['fieldName' => 'metro'])
        </div>

        <div>
            <label for='address'>Address</label>
            <input type='text' name='address' id='address' value='{{ old('address', $place->address) }}'>
            @include('includes.error-field', ['fieldName' => 'address'])
        </div>

        <div>
            <label for='description'>Description</label>
            <input type='text' name='description' id='description'
                value='{{ old('description', $place->description) }}'>
            @include('includes.error-field', ['fieldName' => 'description'])
        </div>

        <div>
            <label for='visit_length'>How long is the average visit length?</label>
            <input type='text' name='visit_length' id='visit_length'
                value='{{ old('visit_length', $place->visit_length) }}'>
            @include('includes.error-field', ['fieldName' => 'visit_length'])
        </div>

        <div>
            <label for='reservation'>Is a reservation required?</label>
            <input type='checkbox' name='reservation' id='reservation' value='reservation'
                {{ old('reservation') == 'reservation' ? 'checked' : $place->reservation }}>
            @include('includes.error-field', ['fieldName' => 'reservation'])
        </div>

        <div>
            <label for='fee'>Is there a fee for entry?</label>
            <input type='checkbox' name='fee' id='fee' value='fee'
                {{ old('fee') == 'fee' ? 'checked' : $place->fee }}>
            @include('includes.error-field', ['fieldName' => 'fee'])
        </div>

        <div>
            <button type='submit' class='btn btn-primary'>Submit edits</button>
        </div>

    </form>
    <div>
        @include('layouts/backtomytrips')
    </div>
@endsection
