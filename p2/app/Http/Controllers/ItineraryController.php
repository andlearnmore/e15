<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index() {
        # This page will contain the form.
        return view('itinerary/index');
    }

    public function show() {
        # This page will show the completed itinerary.
        return view('itinerary/show');
    }
}