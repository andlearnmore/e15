<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * GET /
     * Display the application welcome page with a search feature
     */
    
     public function welcome()
     {
         # If there is data stored in the session as the results of doing a search
         # that data will be extracted from the session and passed to the view
         # to display the results
         return view('pages/welcome',[
             'searchTerms' => session('searchTerms', null),
             'searchType' => session('searchType', null),
             'searchResults' => session('searchResults', null)
         ]);
    }
 
    public function contact() {
        return view('pages/contact');
    }

}