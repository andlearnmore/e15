<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * GET /
     * Display all cities
     */
    public function index()
    {
        return view('countries/index');
    }

    public function create()
    {
        return view('countries/create');
    }
}