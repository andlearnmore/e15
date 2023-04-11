<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * GET /
     * Display all cities
     */
    public function index()
    {
        return view('cities/index');
    }

    public function create()
    {
        return view('cities/create');
    }
}