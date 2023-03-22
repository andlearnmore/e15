@extends('layouts/main')

@section('title')
    @if (!is_array($plans) || count($plans) == 0)
        {{ 'Visit Berlin' }}
    @else
        {{ $itineraryName }}
    @endif
@endsection

@section('content')
    <h1>{{ $itineraryName }}</h1>
    @if (!is_array($plans) || count($plans) == 0)
        <div class='text-center'>
            <p>Tell us about your trip and we'll create an itinerary for you!</p>
            <a class="btn btn-primary" href="/planner" role="button">Tell us about your trip!</a>
        </div>
    @else
        <p> You selected {{ $dayStart == '9' ? 'Early Bird ' : 'Night Owl ' }}
            so we started your itinerary at {{ $dayStart == '9' ? '9:00' : '12:00' }}.
        </p>
        <p> Below is an itinerary for your {{ $tripLength }}-day trip to Berlin.</p>

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
                    <td><b>{{ $plan['loc_name'] }}</b></td>
                    <td>{{ $plan['address'] }}
                        <br>
                        @if ($plan['depart'] != '')
                            @if ($plan['loc_name'] != 'Break until the next location opens.')
                                <b>U- or S-Bahn Stop:</b> {{ $plan['loc_metro'] }}
                                <br><b>Hours: </b>{{ $plan['loc_open'] }} - {{ $plan['loc_closed'] }}
                                <br><a href='{{ $plan['url'] }}' target='_blank'>{{ $plan['url'] }}</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>
        <br>
        @if ($unscheduledLocations)
            <h2> Unscheduled Locations </h2>
            <p>If you tried to squeeze too many activities into too few days, we couldn't schedule everything in. </p>
            <p>Occasionally, we are unable to include an activity in your itinerary because of the opening and closing
                times.</p>
        @endif
        <div class='row'>
            <div class='col-3'></div>
            <div class='col-6'>
                <table class='table table-striped'>

                    @foreach ($unscheduledLocations as $unscheduledLocation)
                        <tr>
                            <td>{{ $unscheduledLocation['loc_name'] }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class='col-3'></div>
        </div>


        <div class='text-center'>
            <a class="btn btn-primary" href="/planner" role="button">Plan a new trip</a>
        </div>
    @endif


@endsection
