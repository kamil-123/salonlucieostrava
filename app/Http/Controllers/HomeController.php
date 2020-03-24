<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id  = auth()->id();
        $stylist = User::with('stylist')
                        ->get();
                // ->where('id', $user_id)
                // ->first();
        return $stylist;
        // $test = gettype($stylist);
        // return view('home', compact('stylist', 'dates'));
    }
}
