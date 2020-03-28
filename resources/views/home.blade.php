@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">

                    {{-- (Default) --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{-- GENERAL Error Message --}}
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif

                    {{-- Customized Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
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
                        <span class="table-add float-right mb-3 mr-2">
                            <a href="#!" class="text-success">
                                <i class="fas fa-plus fa-2x" aria-hidden="true"></i>
                            </a>
                        </span>

                        @if ($message !== '')) 
                            <div class="row d-flex my-4">   
                                <div class='mx-auto'>{{ $message }}</div>
                            </div>
                        @else

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
                                @foreach($full_schedule[$date] as $timeslot => $info)
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
                                                        href={{ action('BookingViewController@create', ['timeslot' => $timeslot]) }}
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
                                                    <form
                                                        action={{ action('BookingViewController@block', ['timeslot' => $timeslot, 'date' => array_keys($full_schedule)[0]] ) }}
                                                        class="mx-auto"
                                                        method="POST"
                                                    >
                                                        @csrf
                                                        <input type="hidden" name="timeslot" value="{{ $timeslot }}">
                                                        <input type='submit' value='Block' class='btn btn-danger'>
                                                    </form>
                                                @elseif ($info['availability'] === 0) 
                                                    <form 
                                                        method='POST' 
                                                        action={{ action('BookingViewController@destroy', ['id' => $info['booking_id']]) }}
                                                        class='mx-auto'
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type='hidden' name='id' value={{ $info['booking_id'] }}>
                                                        <input type='submit' value='Unblock' class='btn btn-warning'>
                                                    </form>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                        @endif
                                
                            
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
