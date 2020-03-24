<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;

class HomeController extends Controller
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
        // get user id of the current logged-in user
        $user_id  = auth()->id();

        // get stylist information 
        $stylist = User::with('stylist.bookings')
                        ->findOrFail($user_id);
        $stylist_id = $stylist->stylist->id;

        // get schedule of the currently logged-in stylist
        $today = date("Y-m-d H:i:s");
        $bookings = Booking::where('stylist_id', $stylist_id)
                            ->where('start_at' , '>=', $today) // fetch only future schedule
                            ->orderBy('start_at' , 'asc')
                            ->get();

        // formatting the fetched data
        $schedule = [];
        foreach($bookings as $booking) {
            $stylist_id = $booking->stylist_id;
            $booking_id = $booking->id;
            $date_time = explode(" ", $booking['start_at']);
            $date = $date_time[0];
            $time = $date_time[1];
            
            if (array_key_exists($stylist_id, $schedule)) { // if a stylist has any bookings:
                if (array_key_exists($date, $schedule[$stylist_id])) { // if the stylist has a certain day in his/her bookings:
                    $schedule[$stylist_id][$date][$time] = ['booking_id' => $booking_id, 'availability' => $booking->availability];
                } else { 
                    $schedule[$stylist_id][$date] = [$time => ['booking_id' => $booking_id, 'availability' => $booking->availability]]; 
                }
            } else {
                $schedule[$stylist_id] = [$date => [$time => ['booking_id' => $booking_id, 'availability' => $booking->availability]]];
            }
        }

        // combine fetched data and the template
        $full_schedule = [];
        foreach ($schedule as $stylist => $dates) {
            foreach ($dates as $date => $timeSlots) {
                $full_day_schedule = array_merge($this->timeSlotTemplate, $timeSlots);
                $full_schedule[$stylist][$date] = $full_day_schedule;
            }; 
        };
        // just sending the schedule for the currently logged-in stylist
        $full_schedule = $full_schedule[$stylist_id];
        $dates = array_keys($full_schedule);
        // return $full_schedule;
        return view('home', compact('stylist', 'full_schedule', 'dates'));
    }
}
