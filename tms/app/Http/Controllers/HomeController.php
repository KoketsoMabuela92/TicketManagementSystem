<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['normal', 'emailer', 'anonymous']);
        logger($request->user());
        logger($request->user()->roles[0]['name']);
        if ($request->user()->roles[0]['name'] === 'normal') {

            return view('log_ticket');
        }
        return view('home');
    }
}
