@extends('layouts/main')

@section('title')
    My Itinerary
@endsection

@section('content')
    <h1>The itinerary will display here.</h1>
    <table>
        <tr>
            <th>Time</th>
            <th>Location Name</th>
            <th>Address</th>
            <th>U- or S-Bahn Stop</th>
            <th>Opens</th>
            <th>Closes</th>
        </tr>
        @foreach ($itineraryLocations as $plan)
            {{-- TODO: $itineraryLocations will become '$plans' --}}
            <tr>
                {{-- <td>time</td> --}}
                {{-- TODO: in Controller, make $plans with a $startTime and $endTime --}}
                <td>{{ $plan['loc_name'] }}</td>
                <td>{{ $plan['address'] }}</td>
                <td>{{ $plan['loc_metro'] }}</td>
                <td>{{ $plan['loc_open'] }}</td>
                <td>{{ $plan['loc_closed'] }}</td>

            </tr>
        @endforeach
    </table>
@endsection
