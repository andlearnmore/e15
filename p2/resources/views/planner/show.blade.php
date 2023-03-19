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
        @foreach ($plans as $plan)
            {{-- TODO: $itineraryLocations will become '$plans' --}}
            {{-- TODO: Need to have conditional to look for day 1 and day 2, etc. --}}
            <tr>
                <td>{{ $plan['arrive'] }}:00 - {{ $plan['depart'] }}:00 </td>
                {{-- <td>{{ $plan['depart'] }}</td> --}}
                <td>{{ $plan['loc_name'] }}</td>
                <td>{{ $plan['address'] }}</td>
                <td>{{ $plan['loc_metro'] }}</td>
                <td>{{ $plan['loc_open'] }}</td>
                <td>{{ $plan['loc_closed'] }}</td>

            </tr>
        @endforeach
    </table>
@endsection
