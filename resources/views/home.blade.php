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

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                {{----- CALENDAR -----}}

                    @foreach ($dates as $date)
                        <h3>{{$date}}</h3>
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
                                @foreach($full_schedule[$date] as $timeslot => $availability)
                                    <tr>
                                    <td class="pt-3-half" contenteditable="true">{{ $timeslot }}</td>
                                    <td class="pt-3-half" contenteditable="true">
                                        {{
                                            $availability[0] === null ? 'Available'
                                            : ($timeslot === 1 ? 'Blocked' : 'Booked')
                                        }}
                                    </td>
                                    <td>
                                        @if ($availability[0] === null) 
                                            <a href={{ action('BookingViewController@show', $availability[1])}}>Details</a></td>
                                        @endif
                                    <td>
                                        <span class="table-remove">
                                            @if ($availability[0] === null) 
                                                <button type="button"
                                                class="btn btn-primary btn-rounded btn-sm my-0">
                                                Book
                                                </button>
                                            @elseif ($availability[0] === 1) 
                                                {{-- <button type="button"
                                                class="btn btn-secondary btn-rounded btn-sm my-0" disabled> --}}
                                                Blocked
                                                {{-- </button> --}}
                                            @else 
                                                <button type="button"
                                                class="btn btn-warning btn-rounded btn-sm my-0">
                                                Cancel the Order
                                                </button>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span class="table-remove">
                                            @if ($availability[0] === null) 
                                                <button type="button"
                                                class="btn btn-danger btn-rounded btn-sm my-0">Block This Time</button>
                                            @elseif ($availability[0] === 1) 
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
                    @endforeach

                {{----- END OF CALENDAR -----}}
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
