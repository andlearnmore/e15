<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{

    /** 
     * GET /profile
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return view('pages/profile', [
            'user' => $user
        ]);
    }
    /**
    * GET /profile/{name}/edit
    */
    public function edit(Request $request)
    {     
        $user = $request->user();
        return view('pages/edit', [
            'user' => $user
        ]);
    }

    /**
     * POST /profile/{name}
     */

     public function update(Request $request)
     {
        $user= $request->user();
        
        $request->validate([
            'name' => 'required|max:100'
        ]);

        $user->name = $request->name;
        $user->about = $request->about;
        $user->save();

        return view('pages/profile', [
            'user' => $user
        ]);
     }

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