<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
  
  
class BookingController extends Controller
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
        $today = date("Y-m-d H:i:s");
        $tenDaysLater = date('Y-m-d H:i:s', strtotime($today. ' + 14 days'));
        $bookings = Booking::orderBy('start_at', 'asc')
                        ->where('start_at' , '>=', $today) // fetch only future schedule
                        ->where('start_at' , '<=', $tenDaysLater) // fetch schedule only within 14 days in future
                        ->get();     

        // formatting the fetched data
        $schedule = [];
        foreach($bookings as $booking) {
            $stylist_id = $booking->stylist_id;
            $date_time = explode(" ", $booking['start_at']);
            $date = $date_time[0];
            $time = $date_time[1];
            
            if (array_key_exists($stylist_id, $schedule)) {
                if (array_key_exists($date, $schedule[$stylist_id])) {
                    $schedule[$stylist_id][$date][$time] = $booking->availability;
                } else {
                    $schedule[$stylist_id][$date] = [$time => $booking->availability]; 
                }
            } else {
                $schedule[$stylist_id] = [$date => [$time => $booking->availability]];
            }
        }
        
        // REFERENCE - $schedule looks like:
        //  [ stylist_id_1 => [date_1 => [time_1 => availability, time_2 => availability], 
        //                     date_2 => [time_3..]],
        //    stylist_id_2 => [date_1 => [time_4 => availability],
        //                     date_2 => [...]], 
        //  ]

        // combine fetched data and the template
        $full_schedule = [];
        foreach ($schedule as $stylist => $dates) {
            foreach ($dates as $date => $timeSlots) {
                $full_day_schedule = array_merge($this->timeSlotTemplate, $timeSlots);
                $full_schedule[$stylist][$date] = $full_day_schedule;
            }; 
        };

        return $full_schedule;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // we do not need the create() method in api.
        // page viewing will be handled by React route
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated  = $request->validate([
            'stylist_id' => 'required',
            'customer_id' => 'required',
            'treatment_id' => 'required',
            'start_at' => 'required',
            'availability' => 'required',
        ]);

        $booking = Booking::create($validated);

        // return new booking information
        return response()->json($booking, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // we do not need the edit() method in api.
        // page viewing will be handled by React route.
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
        $validated  = $request->validate([
            'stylist_id' => 'required',
            'customer_id' => 'required',
            'treatment_id' => 'required',
            'start_at' => 'required',
            'availability' => 'required',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->stylist_id = $validated['stylist_id'];
        $booking->customer_id = $validated['customer_id'];
        $booking->treatment_id = $validated['treatment_id'];
        $booking->start_at = $validated['start_at'];
        $booking->availability = $validated['availability'];
        $booking->save();

        // return updated booking infomation
        return response()->json($booking, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    }
}
