@extends('layouts/main')

@section('title')
    @if (!is_array($plans) || count($plans) == 0)
        {{ 'Visit Berlin' }}
    @else
        {{ $itineraryName }}
    @endif
@endsection

@section('content')
    <h1>
        {{ $itineraryName }}</h1>
    @if (!is_array($plans) || count($plans) == 0)
        <p>Tell us about your trip and we'll create an itinerary for you!
        <p>
            <a class="btn btn-primary" href="/planner" role="button">Tell us about your trip!</a>
        @else
        <table class='table table-striped'>
            <tr>
                <th>Time</th>
                <th>Location Name</th>
                <th>Details</th>
            </tr>
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan['arrive'] }}
                        @if ($plan['depart'] != '')
                            :00 -
                        @endif{{ $plan['depart'] }}
                        @if ($plan['depart'] != '')
                            :00
                        @endif
                    </td>
                    <td>{{ $plan['loc_name'] }}</td>
                    <td>{{ $plan['address'] }}
                        <br>
                        @if ($plan['depart'] != '')
                            <b>U- or S-Bahn Stop:</b> {{ $plan['loc_metro'] }}
                            <br><b>Hours: </b>{{ $plan['loc_open'] }} - {{ $plan['loc_closed'] }}
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>
        <br>
        @if ($unscheduledLocations)
            <h2> Unscheduled Locations </h2>
        @endif

        @foreach ($unscheduledLocations as $unscheduledLocation)
            <ul>
                <li>{{ $unscheduledLocation['loc_name'] }}</li>
            </ul>
        @endforeach
    @endif

    <a class="btn btn-primary" href="/planner" role="button">Plan a new trip</a>

@endsection
