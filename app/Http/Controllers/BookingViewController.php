<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Treatment;
use App\Customer;

class BookingViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $timeSlotTemplate = [
        '09:00:00' => null,
        '09:30:00' => null,
        '10:00:00' => null,
        '10:30:00' => null,
        '11:00:00' => null,
        '11:30:00' => null,
        '12:00:00' => null,
        '12:30:00' => null,
        '13:00:00' => null,
        '13:30:00' => null,
        '14:00:00' => null,
        '14:30:00' => null,
        '15:00:00' => null,
        '15:30:00' => null,
        '16:00:00' => null,
        '16:30:00' => null,
      ];

    
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
        $treatments = Treatment::all();
        return view('stylist.add_booking')->with([
            'timeSlotTemplate' => array_keys($this->timeSlotTemplate),
            'treatments' => $treatments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // get stylist_id
        $user_id  = auth()->id();
        $stylist = User::with('stylist')
                        ->findOrFail($user_id);
        $stylist_id = $stylist->stylist->id;

        // create a new row in bookings table 
        $booking = new Booking;
        $booking->stylist_id = $stylist_id;
        $booking->treatment_id = $request->input('treatment');
        $booking->availability = 1; // 1 = booked

        [$y, $mon, $d] = explode('-', $request->input('date'));
        [$h, $min, $s]= explode(':', $request->input('time'));
        $datetime = date('Y-m-d H:i:s', mktime($h, $min, $s, $mon, $d, $y));
        $booking->start_at =  $datetime;

        //  check whether the customer already has a record in DB
        $customer = Customer::where('email', $request->input('email'))->first();
        if($customer !== null) { // if a record exist, get the id and assign it to customer_id
            $customer->bookings()->save($booking);

        } else { // if not, create a new record in customers table
            $customer = new Customer;
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->save();
            $booking->customer_id = $customer->id;
            $booking->push();

            return $booking->customer;  
        }

        return redirect()->action('BookingViewController@show', ['id'=> $booking->id]);
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

        $treatments = Treatment::all();
        // return $booking;
        return view('stylist.edit_booking')->with([
            'id' => $id,
            'booking' => $booking,
            'time' => $time,
            'date' => $date,
            'y' => $y,
            'm' => $m, 
            'd' => $d,
            'timeSlotTemplate' => array_keys($this->timeSlotTemplate),
            'treatments' => $treatments,
        ]);
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
        $booking = Booking::with('customer')
                            ->with('treatment')
                            ->findOrFail($id);

        $booking->treatment_id = $request->input('treatment');
        $booking->customer->first_name = $request->input('first_name');
        $booking->customer->last_name = $request->input('last_name');
        $booking->customer->phone = $request->input('phone');
        $booking->customer->email = $request->input('email');

        [$y, $mon, $d] = explode('-', $request->input('date'));
        [$h, $min, $s]= explode(':', $request->input('time'));
        $datetime = date('Y-m-d H:i:s', mktime($h, $min, $s, $mon, $d, $y));
        $booking->start_at =  $datetime;
        $booking->save();

        return redirect()->action('BookingViewController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteConfirmation($id)
    {
        $booking = Booking::with('customer')
                            ->with('treatment')
                            ->findOrFail($id);
        [$date, $time] = explode(' ', $booking->start_at);

        return view('stylist.delete_confirmation_booking')->with([
            'id' => $id,
            'booking' => $booking,
            'time' => $time,
            'date' => $date,
            ]);
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('home');
    }
}
