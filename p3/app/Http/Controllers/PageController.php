<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    /**
     * GET /
     * Display application welcome page 
     */
    public function welcome()
    {
        $welcomeMessage = "Hello and welcome to this page.";
        return view('pages/welcome', [
            'welcomeMessage' => $welcomeMessage
        ]);
    }

        /**
     * GET /
     * Display contact page 
     */

     public function contact()
     {
        return view('pages/contact');
     }

}