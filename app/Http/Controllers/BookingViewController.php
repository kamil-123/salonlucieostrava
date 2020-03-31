<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Treatment;
use App\Customer;
use App\Stylist;

class BookingViewController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // for debugging
        return view('stylist.test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($timeslot)
    {   
        // get stylist_id
        $user_id  = auth()->id();
        $user = User::with('stylist.treatments')
                        ->findOrFail($user_id);
        $stylist_id = $user->stylist->id;

        // get the list of treatments
        $treatments = $user->stylist->treatments;

        return view('stylist.add_booking')->with([
            'timeslot' => $timeslot,
            'treatments' => $treatments,
            'timeSlotTemplate' => array_keys($this->timeSlotTemplate),
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
         $user = User::with('stylist.treatments')
                         ->findOrFail($user_id);
         $stylist_id = $user->stylist->id;
 
         // get the list of treatments
         $treatments = [];
         foreach($user->stylist->treatments as $treatment) {
            array_push($treatments, $treatment);
         }
        
        // get the requested booking 
        $editing_booking = Booking::with('customer')
                        ->with('treatment')
                        ->findOrFail($id);
        [$date, $time] = explode(' ', $editing_booking->start_at);
        [$y, $m, $d] = explode('-', $date);

        // get only the free timeslots
        $start_of_the_day = $date . ' 00:00:00';
        $end_of_the_day = $date . ' 23:59:59';

        $bookings  = Booking::where('stylist_id', $stylist_id)
                            ->where('start_at','>', $start_of_the_day)
                            ->where('start_at','<', $end_of_the_day)
                            ->orderBy('start_at' , 'asc')
                            ->get();

        // formatting the fetched data
        $formatted_all_schedule = [];
        $message = '';
        $dates = [];
        if( isset($bookings[0]) ) { // if at least one booking exists on the day
            $schedule = [];
            $test = [];
            foreach($bookings as $booking) {
                $stylist_id = $booking->stylist_id;
                $booking_id = $booking->id;
                [$date, $time] = explode(" ", $booking['start_at']);
                
                if (array_key_exists($stylist_id, $schedule)) { // if a stylist has any bookings:
                    if (array_key_exists($date, $schedule[$stylist_id])) { // if the stylist has a certain day in his/her bookings:
                        $schedule[$stylist_id][$date][$time] = ['booking_id' => $booking_id, 
                                                                'availability' => $booking->availability,
                                                                'duration' => isset($booking->treatment) ? $booking->treatment->duration : null,
                                                                ];
                    } else { 
                        $schedule[$stylist_id][$date] = [$time => ['booking_id' => $booking_id, 
                                                                    'availability' => $booking->availability,
                                                                    'duration' => isset($booking->treatment) ? $booking->treatment->duration : null,
                                                                    ]]; 
                    }
                } else {
                    $schedule[$stylist_id] = [$date => [$time => ['booking_id' => $booking_id, 
                                                                'availability' => $booking->availability,
                                                                'duration' => isset($booking->treatment) ? $booking->treatment->duration : null,
                                                                ]]];
                }
            }
            
            // combine fetched data and the template
            foreach ($schedule as $stylist => $dates) {
                foreach ($dates as $date => $timeSlots) {
                    $full_day_schedule = array_merge($this->timeSlotTemplate, $timeSlots);
                    $formatted_all_schedule[$stylist][$date] = $full_day_schedule;
                }; 
            };


            // Reflecting treatment duration 
            $isContinuing = false;
            $prevBooking = [];
            $full_schedule[$stylist][$date] = [];
            foreach ( $formatted_all_schedule[$stylist][$date] as $timeslot => $info ) {

                if ( isset($info) ) {
                    if ( $info['availability'] === 1 ) { // the timeslot is booked

                        //  calculate the number of timeslots one booking takes
                        [$hour, $minute, $s] = explode(":", $info['duration']);
                        $slot = $minute === '30' ? 1 : 0; // if $minute='30', +1 slot. else 0 slot.
                        $slot += (int)$hour * 2; // if $hour='1', +2 slots 
                        $isContinuing = $slot > 1 ? true : false;
                        $prevBooking = $info;
                    } 
                } else { // the timeslot is free
                    if( $isContinuing ) { // the timeslot should be booked as continuation of the previous booking 
                        $info = $prevBooking; // copy previous booking details
                        $slot -= 1; // one slot (30 min) consumed
                        $isContinuing = $slot > 1 ? true : false; // check whether the slot should still be continuing
                    }
                }
                $full_schedule[$stylist][$date][$timeslot] = $info;
            }

            // just sending the schedule for the currently logged-in stylist
            $full_schedule = $full_schedule[$stylist_id];
            $date = array_keys($full_schedule)[0];
        } 

        $free_slots = [];
        foreach($full_schedule[$date] as $timeslot => $info) { 
            if( !($info['booking_id']) ) {
                array_push($free_slots, $timeslot);
            }
        }

        // return $free_slots;
        return view('stylist.edit_booking')->with([
            'id' => $id,
            'booking' => $editing_booking,
            'time' => $time,
            'date' => $date,
            'y' => $y,
            'm' => $m, 
            'd' => $d,
            'free_slots' => $free_slots,
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


    public function block(Request $request) {
        // get stylist_id
        $user_id  = auth()->id();
        $user = User::with('stylist')
                        ->findOrFail($user_id);
        $stylist_id = $user->stylist->id;

        // create a new booking with availability 0 
        $booking = new Booking;
        $booking->availability = 0; // 0 = blocked
        $booking->stylist_id = $stylist_id;
        $booking->customer_id = null;
        $booking->treatment_id = null;

        [$y, $mon, $d] = explode('-', $request->input('date'));
        [$h, $min, $s]= explode(':', $request->input('timeslot'));
        $datetime = date('Y-m-d H:i:s', mktime($h, $min, $s, $mon, $d, $y));
        $booking->start_at =  $datetime;
        $booking->save();

        // return $booking;
        return redirect()->route('home')->with('success', 'the selected timeslot was blocked.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('home')->with('success', 'the selected timeslot is free now.');
    }
}
