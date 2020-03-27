<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;


class BookingViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get stylist_id
        $user_id  = auth()->id();
        $stylist = User::with('stylist')
                        ->findOrFail($user_id);
        $stylist_id = $stylist->stylist->id;
        
        // get a certain booking 
        $booking = Booking::with('customer')
                        ->with('treatment')
                        ->findOrFail($id);
        [$date, $time] = explode(" ",$booking->start_at);
        // return $booking;
        return view('stylist.show_booking')->with(['id'=> $id, 'booking' => $booking, 'time' => $time, 'date' => $date]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get stylist_id
        $user_id  = auth()->id();
        $stylist = User::with('stylist')
                        ->findOrFail($user_id);
        $stylist_id = $stylist->stylist->id;
        
        // get a certain booking 
        $booking = Booking::with('customer')
                        ->with('treatment')
                        ->findOrFail($id);
        [$date, $time] = explode(' ', $booking->start_at);
        [$y, $m, $d] = explode('-', $date);
        // return $booking;
        return view('stylist.edit_booking', compact('id', 'booking', 'time', 'date', 'y', 'm', 'd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteConfirmation($id)
    {
        return view('stylist.delete_confirmation_booking');
    }


    public function destroy($id)
    {
        //
    }
}
