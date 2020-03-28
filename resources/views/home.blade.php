@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="card-text">You are logged in!</p>
                    <form  class="btn" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <input type="submit" value="Logout">
                    </form>
                </div>
            </div>
        </div>
{{----- CALENDAR -----}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                    <p class="card-text">Checkout the monthly schedule here.</p>
                    <a class="btn btn-secondary" href={{ route('calendar', ['id' => 0] )}}>
                        Go to Your Calendar
                    </a>
                </div>
            </div>
        </div>


{{----- TODAY'S SCHEDULE -----}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Today's Schedule</div>
                <div class="card-body">
                    <h3>{{ date("d-m-Y") }}</h3>
                        <div id="table" class="table-editable">
                            <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
                                class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                <th class="text-center">Time</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Information</th>
                                <th class="text-center">Book</th>
                                <th class="text-center">Block</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($full_schedule[$dates[0]] as $timeslot => $info)
                                    <tr>
                                    <td class="pt-3-half" contenteditable="true">{{ $timeslot }}</td>
                                    <td class="pt-3-half" contenteditable="true">
                                        {{
                                            $info['availability'] === null ? 'Available'
                                            : ($info['availability'] === 1 ? 'Booked' : 'Blocked')
                                        }}
                                    </td>
                                    <td>
                                        @if ($info['availability'] === 1) 
                                            <a href={{ route('booking.details', ['id' => $info['booking_id']]) }}>Details</a></td>
                                        @endif
                                    <td>
                                        <span class="table-remove">
                                            @if ($info['availability'] === null) 
                                                <a
                                                    class="btn btn-primary btn-rounded btn-sm my-0"
                                                    href={{ action('BookingViewController@create') }}
                                                >
                                                    Book
                                                </a>
                                            @elseif ($info['availability'] === 0) 
                                                Blocked
                                            @else 
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span class="table-remove">
                                            @if ($info['availability'] === null) 
                                                <button type="button"
                                                class="btn btn-danger btn-rounded btn-sm my-0">Block</button>
                                            @elseif ($info['availability'] === 0) 
                                                <button type="button"
                                                class="btn btn-default btn-secondary btn-sm my-0">Unblock</button>
                                            @endif
                                        </span>
                                    </td>
                                    </tr>
                                @endforeach
                                <!-- This is our clonable table line -->
                            </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

         
        {{--  TESTING --}}
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Schedule</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="card-text">Schedule of this week</p>
                    <ul>
                        @foreach ($dates as $date)
                        <li>{{ $date }}</li>
                            <ul>
                            @foreach ($full_schedule[$date] as $timeslot)
                                <li>
                                {{
                                    $timeslot === 0 ? 'Booked'
                                    : ($timeslot === 1 ? 'Blocked' : 'Yay available!')
                                }}
                                </li>
                            @endforeach
                            </ul>
                        @endforeach
                    </ul>

                    </p>
                </div>
            </div>      
        </div> --}}
    </div>
</div>
@endsection
