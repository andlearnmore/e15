@extends('layouts/main')

@section('title')
    My Itinerary
@endsection

@section('content')
    <h1>
        {{ $itineraryName }}</h1>
    @if (!is_array($plans) || count($plans) == 0)
        <p>Tell us about your trip and we'll create an itinerary for you!
        <p>
            <a href='/planner'>Tell us about your trip!</a>
        @else
        <table>
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
                            U- or S-Bahn Stop: {{ $plan['loc_metro'] }}
                            <br>Hours: {{ $plan['loc_open'] }} - {{ $plan['loc_closed'] }}
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
@endsection
